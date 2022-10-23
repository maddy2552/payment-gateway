<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class StripeMerchant implements InvokableRule
{
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
        if ((int) config('services.payment-gateway.stripe.merchant_id') !== (int) $value) {
            $fail('validation.custom.stripe.merchant')->translate();
        }
    }
}
