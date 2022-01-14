<?php

namespace App\Http\Livewire\Page;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCart extends Component
{
    public function render()
    {
        return view('livewire.page.shopping-cart', [
            'cartItems' => Cart::instance('shopping')->content(),
            'subtotal' => Cart::instance('shopping')->subtotal()
        ]);
    }
}
