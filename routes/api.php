<?php

use App\Http\Controllers\API\CallBackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * -----------------
 * m-pesa endpoints
 * -----------------
 */
Route::group([
    'prefix' => 'callbacks',
    'namespace' => 'API'
], function () {
    Route::post('stk', [CallBackController::class, 'stkCallBack'])->name('stk.callback');
    Route::post('confirm', [CallBackController::class, 'confirmCallBack'])->name('confirm.callback');
    Route::post('validate', [CallBackController::class, 'validateCallBack'])->name('validate.callback');
});


Route::get('sys/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
