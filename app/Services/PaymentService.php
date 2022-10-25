<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\EntityNotFoundException;

class PaymentService
{
    /**
     * @param  int  $id
     * @param  array  $relations
     * @return Payment
     * @throws EntityNotFoundException
     */
    public function findById(int $id, array $relations = []): Payment
    {
        /** @var Payment $payment */
        $payment = Payment::with($relations)->find($id);

        if (!$payment) {
            throw new EntityNotFoundException();
        }

        return $payment;
    }

    /**
     * @param  int  $id
     * @param  array  $data
     * @param  array  $relations
     * @return Payment
     * @throws EntityNotFoundException
     */
    public function update(int $id, array $data, array $relations = []): Payment
    {
        $payment = $this->findById($id, $relations);
        $payment->update($data);

        return $payment;
    }

    /**
     * Updates morph related Stripe/Paypal payment model.
     *
     * @param  Model  $gateway
     * @param  array  $data
     * @return bool
     */
    public function updateGateway(Model $gateway, array $data): bool
    {
        return $gateway->update($data);
    }
}
