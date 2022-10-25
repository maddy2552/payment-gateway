<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StripeWebhookRequest;
use App\Http\Requests\PaypalWebhookRequest;
use App\Actions\StripePaymentWebhookAction;
use App\Actions\PaypalPaymentWebhookAction;

class PaymentWebhookController extends Controller
{
    /**
     * Handle incoming Stripe request.
     *
     * @param  StripeWebhookRequest  $request
     * @param  StripePaymentWebhookAction  $action
     * @return JsonResponse
     * @throws Throwable
     */
    public function handleStripeWebhook(StripeWebhookRequest $request, StripePaymentWebhookAction $action): JsonResponse
    {
        $action->handle($request->validated());
        return $this->respondOk(__('api.payment.stripe.webhook.success'));
    }

    /**
     * Handle incoming Paypal request.
     *
     * @param  PaypalWebhookRequest  $request
     * @param  PaypalPaymentWebhookAction  $action
     * @return JsonResponse
     * @throws Throwable
     */
    public function handlePaypalWebhook(PaypalWebhookRequest $request, PaypalPaymentWebhookAction $action): JsonResponse
    {
        $action->handle($request->validated());
        return $this->respondOk(__('api.payment.paypal.webhook.success'));
    }
}
