<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StripeWebhookRequest;
use App\Http\Requests\PaypalWebhookRequest;

class PaymentWebhookController extends Controller
{
    public function handleStripeWebhook(StripeWebhookRequest $request)
    {

    }

    public function handlePaypalWebhook(PaypalWebhookRequest $request)
    {

    }
}
