<?php

namespace App\Http\Livewire\Page;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductPage extends Component
{
    public $product_id;
    public $review_description;

    public function mount(string $id)
    {
        $this->product_id = $id;
    }

    public function review()
    {
        $this->validate([
            'review_description' => 'required|string'
        ]);

        if (Auth::check()) {
            Review::query()->create([
                'product_id' => $this->product_id,
                'user_id' => auth()->id(),
                'description' => $this->review_description
            ]);

            $this->alert('success', 'Thank you for your review.');
            return redirect()->route('product.page', ['id' => $this->product_id]);
        }

        return redirect()->route('home');

    }

    public function render()
    {
        return view('livewire.page.product-page', [
            'product' => Product::query()
                ->with([
                    'category.product.product_image',
                    'category.product.brand',
                    'product_image',
                    'product_data_sheet',
                    'review.user',
                    'color',
                    'brand',
                    'size',
                    'product_options.option.product'
                ])
                ->findOrFail($this->product_id)
        ]);
    }
}
