<?php

namespace App\Actions;

use JsonException;
use App\Models\PaymentLog;

class LogPaymentWebhookPayloadAction
{
    /**
     * Log request validated payload to database.
     *
     * @param  array  $data
     * @param  int  $paymentId
     * @return PaymentLog
     * @throws JsonException
     */
    public function handle(array $data, int $paymentId): PaymentLog
    {
        return PaymentLog::create([
            'webhook_payload' => json_encode($data, JSON_THROW_ON_ERROR),
            'payment_id' => $paymentId,
        ]);
    }
}
