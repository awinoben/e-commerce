<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\Statement;
use Livewire\Component;
use ShiftechAfrica\CodeGenerator\ShiftCodeGenerator;

class OrderRecords extends Component
{
    protected $listeners = ['orderRecords'];

    public function orderRecords(string $id)
    {
        // get order here
        $order = Order::query()->findOrFail($id);

        // write statements
        Statement::query()->create([
            'user_id' => $order->user_id,
            'transaction_number' => $order->order_number,
            'transaction_type' => config('fusion.transaction_types.order_payment'),
            'reference_number' => (new ShiftCodeGenerator)->generate(),
            'amount' => $order->sub_cost,
            'description' => $order->order_number . ' order payment.',
            'is_debit' => true
        ]);
    }

    public function render()
    {
        return view('livewire.admin.order.order-records');
    }
}
