<?php

namespace App\Http\Livewire\Page;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ComparePage extends Component
{
    public function render()
    {
        return view('livewire.page.compare-page', [
            'cartItems' => Cart::instance('compare')->content()
        ]);
    }
}
