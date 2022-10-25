<?php

namespace App\Actions;

use Throwable;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;

class PaypalPaymentWebhookAction
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    /**
     * Updates paypal change in payment status.
     *
     * @param  array  $data
     * @return int
     * @throws Throwable
     */
    public function handle(array $data): int
    {
        return DB::transaction(function () use ($data) {
            $payment = $this->paymentService->update($data['invoice'], $data, ['gateway']);

            return $this->paymentService->updateGateway($payment->gateway, $data);
        });
    }
}
