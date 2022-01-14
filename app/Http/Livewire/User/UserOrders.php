<?php

namespace App\Http\Livewire\User;

use App\Http\Controllers\API\MpesaController;
use App\Models\Mpesa;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\URL;
use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Livewire\WithPagination;
use PAM\API\STKPush;

class UserOrders extends Component
{
    use FindGuard, WithPagination;

    public $order_id;
    public $search = '';
    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed',
        'cancelled',
        'cancelOrderFunction',
        'markOrderFunction',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function payOrder(string $id)
    {
        $this->order_id = $id;
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

    public function cancelOrder(string $id)
    {
        $this->order_id = $id;
        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'cancelOrderFunction',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function markOrder(string $id)
    {
        $this->order_id = $id;
        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'markOrderFunction',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function markOrderFunction()
    {
        $order = $this->findGuardType()
            ->user()
            ->load('order')
            ->order()
            ->findOrFail($this->order_id);

        $order->update([
            'is_received' => true
        ]);
        foreach ($order->history as $history) {
            $history->update([
                'is_received' => true
            ]);
        }

        // TODO SMS INTEGRATION

        $this->alert(
            'success',
            $order->order_number . ' has been marked as a received order. This means the item has arrived at your destination.'
        );
    }

    public function cancelOrderFunction()
    {
        $order = $this->findGuardType()
            ->user()
            ->load('order')
            ->order()
            ->findOrFail($this->order_id);

        $order->update([
            'is_cancelled' => true
        ]);
        foreach ($order->history as $history) {
            $history->update([
                'is_cancelled' => true
            ]);
        }

        // TODO SMS INTEGRATION

        $this->alert(
            'success',
            $order->order_number . ' has been cancelled.'
        );
    }

    public function confirmed()
    {
        $order = Order::query()
            ->with([
                'user'
            ])
            ->findOrFail($this->order_id);

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

                $this->alert('success', 'Payment for order ' . $order->order_number . ' has been initiated via ' . $this->findGuardType()->user()->phone_number);
                return redirect()->back();
            }

            $this->alert('error', $response->data->Message);
            return redirect()->back();

        } catch (Exception $exception) {
            $this->alert('error', 'Failed to initiate payment. Try again.');
            return redirect()->back();
        }
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.user.user-orders', [
            'orders' => $this->findGuardType()
                ->user()
                ->load('order')
                ->order()
                ->where(function ($query) {
                    $query->orWhere('order_number', 'ilike', '%' . $this->search . '%')
                        ->orWhere('sub_cost', 'ilike', '%' . $this->search . '%');
                })
                ->paginate(10)
        ]);
    }
}
