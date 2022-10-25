<?php

namespace App\Http\Requests;

use Exception;
use App\Rules\PaypalProject;
use JetBrains\PhpStorm\Pure;
use App\Rules\PaypalSignature;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Validation\Rules\Enum;
use App\Enums\PaypalPaymentStatusEnum;
use App\Actions\LogPaymentWebhookPayloadAction;

class PaypalWebhookRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[Pure] #[ArrayShape([
        'project' => "array",
        'invoice' => "string",
        'status' => "array",
        'amount' => "string",
        'amount_paid' => "string",
        'rand' => "string",
        'authorization' => "array"
    ])] public function rules(): array
    {
        return [
            'project' => [
                'required',
                'integer',
                new PaypalProject(),
            ],
            'invoice' => 'required|integer|exists:payments,id',
            'status' => [
                'required',
                new Enum(PaypalPaymentStatusEnum::class),
            ],
            'amount' => 'required|integer',
            'amount_paid' => 'required|integer',
            'rand' => 'required|string',
            'authorization' => [
                'required',
                new PaypalSignature(),
            ],
        ];
    }

    /**
     * Merge data with Authorization header.
     *
     * @return array
     */
    public function validationData(): array
    {
        return array_merge($this->all(), [
            'authorization' => $this->headers->get('authorization'),
        ]);
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     * @throws Exception
     */
    public function passedValidation(): void
    {
        $action = app(LogPaymentWebhookPayloadAction::class);
        $action->handle($this->validated(), $this->validated()['invoice']);
    }
}
