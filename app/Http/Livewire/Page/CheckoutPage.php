<?php

namespace App\Http\Livewire\Page;

use App\Http\Controllers\CacheController;
use App\Http\Controllers\SystemController;
use App\Jobs\ProductQuantityCheckJob;
use App\Models\History;
use App\Models\Location;
use App\Models\Mpesa;
use App\Models\Order;
use App\Models\PaymentOption;
use App\Models\UserDetail;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\URL;
use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use PAM\API\STKPush;

class CheckoutPage extends Component
{
    use FindGuard;

    public $address_one;
    public $address_two;
    public $town;
    public $county;
    public $location_id;
    public $payment_option_id;
    public $notes;
    public $user;
    public $accept_terms = false;
    public $cartItems = [];
    public $shipping_cost = 0;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount()
    {
        $this->cartItems = Cart::instance('shopping')->content();

        if (!count($this->cartItems)) {
            return redirect()->route('shop');
        }

        $this->user = $this->findGuardType()->user()->load('user_detail', 'country');
        $this->address_one = $this->user->user_detail ? $this->user->user_detail->address_one : '';
        $this->address_two = $this->user->user_detail ? $this->user->user_detail->address_two : '';
        $this->town = $this->user->user_detail ? $this->user->user_detail->town : '';
        $this->county = $this->user->user_detail ? $this->user->user_detail->county : '';
        $this->notes = $this->user->user_detail ? $this->user->user_detail->notes : '';
    }

    protected $rules = [
        'town' => 'required|max:255|string',
        'location_id' => 'required|max:255|string',
        'payment_option_id' => 'required|max:255|string',
        'address_one' => 'required|max:255|string',
        'address_two' => 'required|max:255|string',
        'notes' => 'required|string',
        'county' => 'required|max:255|string'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        if (isset($this->location_id) && $this->location_id != 'location') {
            $this->shipping_cost = Location::query()->findOrFail($this->location_id)->cost;
        }

        if (!isset($this->payment_option_id)) {
            $this->addError('payment_option_id', 'The payment option is required.');
        } else {
            $this->resetValidation('payment_option_id');
        }

        $this->cartItems = Cart::instance('shopping')->content();
    }

    public function save()
    {
        $this->cartItems = Cart::instance('shopping')->content();
        $this->validate();
        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        // create user details here
        $user_detail = UserDetail::query()
            ->where('user_id', $this->findGuardType()->id())
            ->where('location_id', $this->location_id)
            ->first();

        if (!$user_detail) {
            UserDetail::query()->create([
                'user_id' => $this->findGuardType()->id(),
                'location_id' => $this->location_id,
                'address_one' => $this->address_one,
                'address_two' => $this->address_two,
                'town' => $this->town,
                'county' => $this->county,
                'notes' => $this->notes
            ]);
        } else {
            $user_detail->update([
                'address_one' => $this->address_one,
                'address_two' => $this->address_two,
                'town' => $this->town,
                'county' => $this->county,
                'notes' => $this->notes
            ]);
        }

        // create order here
        $order = Order::query()->create([
            'user_id' => $this->findGuardType()->id(),
            'payment_option_id' => $this->payment_option_id,
            'quantity' => Cart::instance('shopping')->count(),
            'sub_cost' => SystemController::cartSubTotal() + $this->shipping_cost
        ]);

        // add products to history for shopping
        foreach (Cart::instance('shopping')->content() as $item) {
            History::query()->create([
                'user_id' => $this->findGuardType()->id(),
                'product_id' => $item->model->id,
                'order_id' => $order->id,
                'quantity' => $item->qty,
                'sub_cost' => $item->qty * $item->model->selling_price
            ]);

            // update the products quantity here
            dispatch(new ProductQuantityCheckJob(
                $item->model,
                $item
            ))->onQueue('default')->delay(2);
        }

        $option = PaymentOption::query()->findOrFail($this->payment_option_id);
        if ($option->name === 'M-PESA') {
            try {
                // define options
                $options = [
                    "CallingCode" => "254",
                    "Secret" => env('PAM_APP_SHORTCODE_SECRET_KEY'),
                    "TransactionType" => "CustomerPayBillOnline", // CustomerPayBillOnline or CustomerBuyGoodsOnline
                    "PhoneNumber" => $this->findGuardType()->user()->phone_number,
                    "Amount" => $order->sub_cost,
                    "ResultUrl" => URL::signedRoute('stk.callback'),
                    "Description" => 'Order ' . $order->order_number . ' payment.'
                ];

                // initiate m-pesa payment here
                $response = (new STKPush())->initiateSTK($options);

                if ($response->success) {
                    // create mpesa data
                    Mpesa::query()->create([
                        'user_id' => $this->findGuardType()->id(),
                        'order_id' => $order->id,
                        'reference_number' => $response->data->ReferenceNumber,
                        'phone_number' => $this->findGuardType()->user()->phone_number,
                        'description' => 'Order ' . $order->order_number . ' payment.',
                        'amount' => $order->sub_cost,
                        'attempts' => 1,
                        'options' => $options,
                        'is_initiated' => true,
                        'queued_at' => now()
                    ]);

                    Cart::instance('shopping')->destroy();
                    $this->reset();
                    $this->alert(
                        'success',
                        'Your order has been placed. Payment for order ' . $order->order_number . ' has been initiated via ' . $this->findGuardType()->user()->phone_number
                    );
                    return redirect()->route('user.orders');
                }

                Cart::instance('shopping')->destroy();
                $this->reset();
                $this->alert('error', $response->data->Message);
                return redirect()->route('user.orders');

            } catch (Exception $exception) {
                Cart::instance('shopping')->destroy();
                $this->reset();
                $this->alert('error', 'Failed to initiate payment. Try again.');
                return redirect()->route('user.orders');
            }
        }

        Cart::instance('shopping')->destroy();
        $this->reset();
        $this->alert(
            'success',
            'Your order has been placed.'
        );
        return redirect()->route('user.orders');
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.page.checkout-page', [
            'user' => $this->user,
            'cartItems' => $this->cartItems,
            'subtotal' => Cart::instance('shopping')->subtotal(),
            'payment_options' => CacheController::cachePaymentOptions(),
            'locations' => Location::query()->orderBy('name')->get()
        ]);
    }
}
