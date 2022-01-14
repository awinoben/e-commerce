<?php

namespace App\Jobs;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductQuantityCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $product;
    private object $cart;

    /**
     * Create a new job instance.
     *
     * @param object $product
     * @param object $cart
     */
    public function __construct(object $product, object $cart)
    {
        $this->product = $product;
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // update the products quantity here
        $this->product->update([
            'available_quantity' => ($this->product->available_quantity - $this->cart->qty)
        ]);
        $this->product->refresh();

        // fetch admin here
        $admin = Admin::query()->oldest()->first();

        // send notification for re-order level
        if ($this->product->available_quantity <= $this->product->reordering_level) {
            dispatch(new MailJob(
                $admin->name,
                $admin->email,
                $this->product->name . ' ( ' . $this->product->sku . ' ) Re-Ordering notification.',
                'The quantity has reached the re-ordering level.'
            ))->onQueue('emails')->delay(2);
        }
    }
}
