<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AnalyticsDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.analytics-dashboard')
            ->layout('layouts.admin');
    }
}
