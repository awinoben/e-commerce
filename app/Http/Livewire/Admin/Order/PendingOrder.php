<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class PendingOrder extends Component
{

    use WithPagination;

    public $readyToLoad = false;
    public $search = '';
    public $order = '';

    protected $queryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function getListeners()
    {
        return [
            'confirmed',
            'cancelled',
            'cancelOrderFunction',
            'dispatchOrderFunction',
        ];
    }

    public function markOrder(string $id)
    {
        $this->order = $id;
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
        $this->order = $id;
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

    public function disableOrder(string $id)
    {
        $this->order = $id;
        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'dispatchOrderFunction',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function dispatchOrderFunction()
    {
        $order = Order::query()->with(['history'])->findOrFail($this->order);
        $order->update([
            'is_dispatched' => true
        ]);
        foreach ($order->history as $history) {
            $history->update([
                'is_dispatched' => true
            ]);
        }

        // TODO SMS INTEGRATION

        $this->alert(
            'success',
            $order->order_number . ' has been dispatched.'
        );
    }

    public function cancelOrderFunction()
    {
        $order = Order::query()->with(['history'])->findOrFail($this->order);
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
        $order = Order::query()->with(['history'])->findOrFail($this->order);
        $order->update([
            'is_paid' => true
        ]);
        foreach ($order->history as $history) {
            $history->update([
                'is_paid' => true
            ]);
        }

        // write statements here
        $this->emit('orderRecords', $order->id);

        // TODO SMS INTEGRATION

        $this->alert(
            'success',
            $order->order_number . ' has been marked as paid order.'
        );
    }

    public function cancelled()
    {
        $this->alert('error', 'You have cancelled.');
    }

    public function render()
    {
        return view('livewire.admin.order.pending-order', [
            'orders' => $this->readyToLoad
                ? Order::query()
                    ->with([
                        'user',
                        'payment_option'
                    ])
                    ->latest()
                    ->where('is_paid', false)
                    ->where('is_cancelled', false)
                    ->where(function ($query) {
                        $query->orWhere('order_number', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(10)
                : [],
        ])->layout('layouts.admin');
    }
}
