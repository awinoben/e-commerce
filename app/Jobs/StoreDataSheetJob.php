<?php

namespace App\Jobs;

use App\Http\Controllers\SystemController;
use App\Models\ProductDataSheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreDataSheetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $product;
    private array $datasheet;
    private bool $update;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $product, array $datasheet, bool $update = false)
    {
        $this->product = $product;
        $this->datasheet = $datasheet;
        $this->update = $update;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->update) {
            // remove the existing files
            foreach (ProductDataSheet::query()->where('product_id', $this->product->id)->get() as $sheet) {
                SystemController::un_link_media($sheet->data_sheet, 'sheets');
            }
        }

        foreach ($this->datasheet as $datasheet) {
            $data = SystemController::store_media($datasheet, 'sheets');

            // start saving...
            ProductDataSheet::query()->create([
                'product_id' => $this->product->id,
                'data_sheet' => $data[0],
                'data_sheet_url' => $data[1]
            ]);
        }
    }
}
