<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('paypal_payments', static function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['created', 'inprogress', 'paid', 'expired', 'rejected']);
            $table->string('rand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('paypal_payments');
    }
};
