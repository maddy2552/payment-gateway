<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $amount
 * @property int $amount_paid
 * @property string $gateway_type
 * @property int $gateway_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $gateway
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentLog[] $paymentLogs
 * @property-read int|null $payment_logs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmountPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGatewayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereGatewayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\PaymentFactory factory(...$parameters)
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * Get the payment logs for the payment.
     */
    public function paymentLogs(): HasMany
    {
        return $this->hasMany(PaymentLog::class);
    }

    /**
     * Get the parent gateway model (stripe or paypal).
     */
    public function gateway(): MorphTo
    {
        return $this->morphTo();
    }
}
