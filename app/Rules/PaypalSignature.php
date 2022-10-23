<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class PaypalSignature implements InvokableRule, DataAwareRule
{
    /**
     * All the data under validation.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $sortedData = collect($this->data)->except(['authorization'])->sortKeys();
        $implodedData = $sortedData->implode('.') . config('services.payment-gateway.paypal.app_key');
        $hash = hash('md5', $implodedData);

        if ($hash !== $value) {
            $fail('validation.custom.paypal.signature')->translate();
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data): static
    {
        $this->data = $data;

        return $this;
    }
}
