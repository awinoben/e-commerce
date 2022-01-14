<?php

namespace App\Http\Livewire\Admin;

use App\Models\History;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-dashboard', [
            'sales' => count(History::query()
                ->latest()
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
                ->where('is_paid', true)
                ->get()),
            'customers' => count(User::all()),
            'orders' => count(Order::query()
                ->latest()
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
                ->get()),
        ])->layout('layouts.admin');
    }
}
