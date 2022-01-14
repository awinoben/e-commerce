<?php

namespace App\Http\Livewire\Inc;

use Livewire\Component;

class WishListManager extends Component
{
    protected $listeners = [
        'add_wishlist' => 'addWishList',
    ];

    public function render()
    {
        return view('livewire.inc.wish-list-manager');
    }
}
