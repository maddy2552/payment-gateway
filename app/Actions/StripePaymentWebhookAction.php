<?php

namespace App\Actions;

use Throwable;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;

class StripePaymentWebhookAction
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    /**
     * Updates stripe change in payment status.
     *
     * @param  array  $data
     * @return bool
     * @throws Throwable
     */
    public function handle(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $payment = $this->paymentService->update($data['payment_id'], $data, ['gateway']);

            return $this->paymentService->updateGateway($payment->gateway, $data);
        });
    }
}
