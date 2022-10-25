<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PaymentWebhookController;

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

Route::prefix('payments/webhooks')
    ->name('payments.webhooks.')
    ->group(function () {
        Route::post('/stripe', [PaymentWebhookController::class, 'handleStripeWebhook'])
            ->middleware('throttle:stripe-payment-webhook')
            ->name('stripe');

        Route::post('/paypal', [PaymentWebhookController::class, 'handlePaypalWebhook'])
            ->middleware('throttle:paypal-payment-webhook')
            ->name('paypal');
    });
