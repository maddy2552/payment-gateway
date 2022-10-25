<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use App\Enums\PaypalPaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaypalPayment>
 */
class PaypalPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['rand' => "string", 'status' => "mixed"])]
    public function definition(): array
    {
        return [
            'rand' => Str::random(),
            'status' => $this->faker->randomElement(PaypalPaymentStatusEnum::cases()),
        ];
    }
}
