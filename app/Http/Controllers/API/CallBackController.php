<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SystemController;
use App\Models\Admin;
use App\Models\Mpesa;
use App\Models\Order;
use App\Models\Statement;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Note\Models\Notification;

class CallBackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('call_back_fire_wall')->except('confirmCallBack', 'validateCallBack');
    }

    /**
     * stk call back
     * @param Request $request
     * @return JsonResponse
     */
    public function stkCallBack(Request $request): JsonResponse
    {
        // get the response here and decode
        $response = json_decode($request->getContent());

        // log the payment here
        SystemController::log([
            $response
        ], 'success', 'order_payment');

        // fetch the payment here
        $mpesa = Mpesa::query()
            ->with([
                'user',
                'order.history'
            ])
            ->latest()
            ->whereNull('callback_received_at')
            ->where('reference_number', $response->ReferenceNumber)
            ->first();

        if ($mpesa) {
            if ($response->Success) {
                // to issue no double entry on stk callback and confirm callback
                $exists = Mpesa::query()
                    ->where('transaction_number', $response->MpesaReceiptNumber)
                    ->first();
                if (!$exists) {
                    // sync mpesa here
                    $mpesa->update([
                        'transaction_number' => $response->MpesaReceiptNumber,
                        'is_paid' => true,
                        'is_successful' => true,
                        'payload' => $response,
                        'callback_received_at' => now()
                    ]);

                    // update the order and history(sales)
                    $mpesa->order->update([
                        'is_paid' => true
                    ]);

                    // sales sync
                    foreach ($mpesa->order->history as $history) {
                        $history->update([
                            'is_paid' => true
                        ]);
                    }

                    // write statements
                    Statement::query()->updateOrCreate([
                        'user_id' => $mpesa->user_id,
                        'transaction_number' => $response->MpesaReceiptNumber,
                        'transaction_type' => config('fusion.transaction_types.order_payment'),
                        'reference_number' => $mpesa->reference_number,
                        'amount' => $response->Amount,
                        'description' => $mpesa->order->order_number . ' order payment.',
                        'is_debit' => true
                    ]);

                    // send notifications here
                    Notification::query()->create([
                        'notification_id' => $mpesa->user_id,
                        'notification_type' => User::class,
                        'subject' => 'Mpesa Payment ' . $mpesa->reference_number,
                        'description' => 'Mpesa Payment of KES ' . number_format($response->Amount, 2) . ' has been received.'
                    ]);

                    // send notifications here
                    Notification::query()->create([
                        'notification_id' => Admin::query()->first()->id,
                        'notification_type' => Admin::class,
                        'subject' => 'Mpesa Payment ' . $mpesa->reference_number,
                        'description' => 'Mpesa Payment of KES ' . number_format($response->Amount, 2) . ' has been received.'
                    ]);

                    return response()->json([
                        'The transaction has finished with payment.'
                    ]);
                }
            }

            // sync mpesa here
            $mpesa->update([
                'is_paid' => false,
                'is_successful' => true,
                'payload' => $response,
                'callback_received_at' => now()
            ]);

            return response()->json([
                'Message' => 'Transaction completed.'
            ]);
        }
    }


    /**
     * lipa na mpesa
     * @param Request $request
     * @return JsonResponse
     */
    public function confirmCallBack(Request $request): JsonResponse
    {
        // decode the data here from the mpesa payload response
        $response = json_decode($request->getContent());

        SystemController::log([
            $response
        ], 'info', 'confirm_call_back');

        // fetch this validating double entries

        $exists = Mpesa::query()
            ->where('transaction_number', $response->MpesaReceiptNumber)
            ->first();

        if (!$exists) {
            // check the order to be paid here
            $order = Order::query()
                ->with([
                    'history',
                    'user.wallet'
                ])
                ->firstWhere('order_number', $response->ReferenceNumber);

            // query checker
            if ($order) {
                // update the wallet balance
                $wallet = $order->user->wallet;
                $wallet->current_balance += $response->Amount;
                $wallet->save();

                // create a the payment load
                $mpesa = Mpesa::query()->updateOrCreate([
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'reference_number' => $response->ReferenceNumber,
                    'transaction_number' => $response->MpesaReceiptNumber,
                    'amount' => $response->Amount,
                    'phone_number' => $response->PhoneNumber,
                    'description' => $response->Description,
                    'is_paid' => true,
                    'is_successful' => true,
                    'queued_at' => now(),
                    'callback_received_at' => now()
                ]);

                // to avoid the error above when using updateOrCreate doesn't support json checks
                $mpesa->update([
                    'payload' => $response,
                ]);

                // deduct wallet for the amount that the order should be paid
                $wallet->refresh();
                $wallet->current_balance -= $order->sub_cost;
                $wallet->save();

                // update the order and history(sales)
                $order->update([
                    'is_paid' => true
                ]);

                // sales sync
                foreach ($order->history as $history) {
                    $history->update([
                        'is_paid' => true
                    ]);
                }

                // write the statement
                Statement::query()->updateOrCreate([
                    'user_id' => $wallet->user_id,
                    'reference_number' => $response->ReferenceNumber,
                    'transaction_number' => $response->MpesaReceiptNumber,
                    'transaction_type' => config('fusion.transaction_types.order_payment'),
                    'amount' => $response->Amount,
                    'description' => $response->Description,
                    'is_debit' => true
                ]);

                // send notifications here
                Notification::query()->create([
                    'notification_id' => $wallet->user_id,
                    'notification_type' => User::class,
                    'subject' => 'Mpesa Payment ' . $response->ReferenceNumber,
                    'description' => 'Mpesa Payment of KES ' . number_format($response->Amount, 2) . ' has been received.'
                ]);

                // send notifications here
                Notification::query()->create([
                    'notification_id' => Admin::query()->first()->id,
                    'notification_type' => Admin::class,
                    'subject' => 'Mpesa Payment ' . $response->ReferenceNumber,
                    'description' => 'Mpesa Payment of KES ' . number_format($response->Amount, 2) . ' has been received.'
                ]);

                return response()->json([
                    'The transaction has finished with order payment.'
                ]);
            }

            // Process the payment load so that the admin can use it to make a decision
            $mpesa = Mpesa::query()->updateOrCreate([
                'reference_number' => $response->ReferenceNumber,
                'transaction_number' => $response->MpesaReceiptNumber,
                'amount' => $response->Amount,
                'phone_number' => $response->PhoneNumber,
                'description' => $response->Description,
                'is_paid' => true,
                'is_successful' => true,
                'queued_at' => now(),
                'callback_received_at' => now()
            ]);

            // to avoid the error above when using updateOrCreate doesn't support json checks
            $mpesa->update([
                'payload' => $response,
            ]);

            return response()->json([
                'The transaction has finished with no order payment.'
            ]);
        }
    }


    /**
     * lipa na mpesa
     * @param Request $request
     */
    public function validateCallBack(Request $request)
    {
        // decode the data here from the mpesa payload response
        $response = json_decode($request->getContent());

        SystemController::log([
            $response
        ], 'info', 'validate_call_back');
    }
}
