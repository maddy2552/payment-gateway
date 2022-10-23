<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class PaypalProject implements InvokableRule
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
        if ((int) config('services.payment-gateway.paypal.app_id') !== (int) $value) {
            $fail('validation.custom.paypal.project')->translate();
        }
    }
}
