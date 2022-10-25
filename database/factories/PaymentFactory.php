<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\StripePayment;
use App\Models\PaypalPayment;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['amount' => "int", 'amount_paid' => "int", 'user_id' => UserFactory::class])]
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(100, 10000),
            'amount_paid' => $this->faker->numberBetween(100, 10000),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the payment is done with stripe gateway.
     *
     * @return PaymentFactory
     */
    public function stripeGateway(): PaymentFactory
    {
        return $this->state(function () {
            return [
                'gateway_id' => StripePayment::factory(),
                'gateway_type' => StripePayment::class,
            ];
        });
    }

    /**
     * Indicate that the payment is done with paypal gateway.
     *
     * @return PaymentFactory
     */
    public function paypalGateway(): PaymentFactory
    {
        return $this->state(function () {
            return [
                'gateway_id' => PaypalPayment::factory(),
                'gateway_type' => PaypalPayment::class,
            ];
        });
    }
}
