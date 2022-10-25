<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Enums\StripePaymentStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'timestamp',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => StripePaymentStatusEnum::class,
    ];

    /**
     * Interact with the payment's timestamp.
     *
     * @return Attribute
     */
    protected function timestamp(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => Carbon::createFromTimestamp($value),
        );
    }

    /**
     * Get the stripe gateway's payment.
     *
     * @return MorphOne
     */
    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class, 'gateway');
    }
}
