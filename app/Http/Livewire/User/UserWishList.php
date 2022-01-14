<?php

namespace App\Http\Livewire\User;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;
use Livewire\WithPagination;

class UserWishList extends Component
{
    use FindGuard, WithPagination;

    public $order_id;
    public $search = '';
    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function remove(string $id)
    {
        $wishlist = $this->findGuardType()
            ->user()
            ->load('wish_list.product')
            ->wish_list()
            ->findOrFail($id);
        $wishlist->forceDelete();

        $this->alert('success', $wishlist->product->name . ' has been removed form wishlist.');
    }

    public function render()
    {
        return view('livewire.user.user-wish-list', [
            'wishlists' => $this->findGuardType()
                ->user()
                ->load('wish_list.product')
                ->wish_list()
                ->paginate(10)
        ]);
    }
}
