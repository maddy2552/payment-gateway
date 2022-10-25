<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Payment::factory()
            ->count(5000)
            ->hasPaymentLogs(2)
            ->stripeGateway()
            ->create();

        Payment::factory()
            ->count(5000)
            ->hasPaymentLogs(2)
            ->paypalGateway()
            ->create();
    }
}
