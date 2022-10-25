<?php

namespace Database\Factories;

use JetBrains\PhpStorm\ArrayShape;
use App\Enums\StripePaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StripePayment>
 */
class StripePaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['timestamp' => "int", 'status' => "mixed"])]
    public function definition(): array
    {
        return [
            'timestamp' => $this->faker->unixTime(),
            'status' => $this->faker->randomElement(StripePaymentStatusEnum::cases()),
        ];
    }
}
