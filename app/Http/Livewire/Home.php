<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Slide;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'categories' => Category::query()
                ->with([
                    'product.product_image'
                ])
                ->latest('updated_at')
                ->limit(12)
                ->get(),
            'slides' => Slide::query()->latest()->limit(4)->get()
        ]);
    }
}
