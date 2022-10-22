<?php

namespace App\Models;

use App\Enums\StripePaymentStatusEnum;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StripePayment
 *
 * @property int $id
 * @property string $status
 * @property string $timestamp
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Payment|null $payment
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StripePayment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\StripePaymentFactory factory(...$parameters)
 */
class StripePayment extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => StripePaymentStatusEnum::class,
    ];

    /**
     * Get the stripe gateway's payment.
     */
    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class, 'gateway');
    }
}
