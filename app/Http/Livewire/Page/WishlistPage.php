<?php

namespace App\Http\Livewire\Page;

use App\Models\WishList;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistPage extends Component
{
    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function save()
    {
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
        try {
            if (!Auth::check()) {
                return redirect()->route('user.wishlists');
            } else {
                foreach (Cart::instance('wishlist')->content() as $item) {
                    WishList::query()->updateOrCreate([
                        'user_id' => auth()->id(),
                        'product_id' => $item->model->id
                    ]);
                }
                Cart::instance('wishlist')->destroy();
                $this->alert('success', 'You have successfully saved your wishlist.');
                return redirect()->route('user.wishlists');
            }
        } catch (Exception $exception) {
            $this->alert('error', 'Action can\'t be completed at the moment..');
            return redirect()->back();
        }
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.page.wishlist-page', [
            'cartItems' => Cart::instance('wishlist')->content()
        ]);
    }
}
