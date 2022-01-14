<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LinkProductMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $product_image;
    private array $product_sheet;
    private bool $is_sheets;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $product_image, array $product_sheet = array(), bool $is_sheets = false)
    {
        $this->product_image = $product_image;
        $this->product_sheet = $product_sheet;
        $this->is_sheets = $is_sheets;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
