<?php

namespace App\Models;

use App\Enums\PaypalPaymentStatusEnum;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaypalPayment
 *
 * @property int $id
 * @property string $status
 * @property string $rand
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Payment|null $payment
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment whereRand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalPayment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\PaypalPaymentFactory factory(...$parameters)
 */
class PaypalPayment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'rand',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => PaypalPaymentStatusEnum::class,
    ];

    /**
     * Get the paypal gateway's payment.
     */
    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class, 'gateway');
    }
}
