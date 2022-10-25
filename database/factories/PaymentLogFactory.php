<?php

namespace Database\Factories;

use JsonException;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;
use App\Enums\StripePaymentStatusEnum;
use App\Enums\PaypalPaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentLog>
 */
class PaymentLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws JsonException
     */
    #[ArrayShape(['webhook_payload' => "mixed"])]
    public function definition(): array
    {
        $stripePayload = json_encode([
            'merchant_id' => 6,
            'payment_id' => fake()->numberBetween(1, 5000),
            'status' => fake()->randomElement(StripePaymentStatusEnum::cases()),
            'amount' => fake()->numberBetween(100, 10000),
            'amount_paid' => fake()->numberBetween(100, 10000),
            'timestamp' => fake()->dateTime()->getTimestamp(),
        ], JSON_THROW_ON_ERROR);

        $paypalPayload = json_encode([
            'project' => 816,
            'invoice' => $this->faker->numberBetween(1, 5000),
            'status' => $this->faker->randomElement(PaypalPaymentStatusEnum::cases()),
            'amount' => $this->faker->numberBetween(100, 10000),
            'amount_paid' => $this->faker->numberBetween(100, 10000),
            'rand' => Str::random(),
        ], JSON_THROW_ON_ERROR);

        return [
            'webhook_payload' => $this->faker->randomElement([$stripePayload, $paypalPayload]),
        ];
    }
}
