<?php

namespace App\Http\Requests;

use JetBrains\PhpStorm\Pure;
use App\Rules\StripeMerchant;
use App\Rules\StripeSignature;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Validation\Rules\Enum;
use App\Enums\StripePaymentStatusEnum;

class StripeWebhookRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[Pure] #[ArrayShape([
        'merchant_id' => "array",
        'payment_id' => "string",
        'status' => "array",
        'amount' => "string",
        'amount_paid' => "string",
        'timestamp' => "string",
        'sign' => "array"
    ])] public function rules(): array
    {
        return [
            'merchant_id' => [
                'required',
                'integer',
                new StripeMerchant(),
            ],
            'payment_id' => 'required|integer|exists:payments,id',
            'status' => [
                'required',
                new Enum(StripePaymentStatusEnum::class),
            ],
            'amount' => 'required|integer',
            'amount_paid' => 'required|integer',
            'timestamp' => 'required|integer|min:1',
            'sign' => [
                'required',
                new StripeSignature(),
            ],
        ];
    }
}
