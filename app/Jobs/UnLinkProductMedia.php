<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UnLinkProductMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $product_image;
    private $product_sheet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $product_image, $product_sheet)
    {
        $this->product_image = $product_image;
        $this->product_sheet = $product_sheet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // images
        if ($this->product_image) {
            SystemController::un_link_media($this->product_image->front_image);
            SystemController::un_link_media($this->product_image->back_image);
            SystemController::un_link_media($this->product_image->left_image);
            SystemController::un_link_media($this->product_image->right_image);
        }

        foreach ($this->product_sheet as $product_data_sheet) {
            SystemController::un_link_media($product_data_sheet->data_sheet, 'sheets');
            $product_data_sheet->forceDelete();
        }
    }
}
