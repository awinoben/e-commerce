<?php

namespace App\Jobs;

use App\Services\MpesaStkPushService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MpesaExpressJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $phone_number;
    private string $description;
    private string $result_url;
    /**
     * @var MpesaStkPushService
     */
    private MpesaStkPushService $mpesaStkPushService;
    private string $reference_code;
    private int $amount;

    /**
     * Create a new job instance.
     *
     * @param string $phone_number
     * @param string $description
     * @param int $amount
     * @param string $reference_code
     * @param string $result_url
     * @param MpesaStkPushService $mpesaStkPushService
     */
    public function __construct(string $phone_number, string $description, int $amount, string $reference_code, string $result_url, MpesaStkPushService $mpesaStkPushService)
    {
        $this->phone_number = $phone_number;
        $this->description = $description;
        $this->amount = $amount;
        $this->reference_code = $reference_code;
        $this->mpesaStkPushService = $mpesaStkPushService;
        $this->result_url = $result_url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // initiate the stk push here
        $this->mpesaStkPushService->initiateSTKPush(
            $this->phone_number,
            $this->description,
            $this->amount,
            $this->reference_code,
            $this->result_url
        );
    }
}
