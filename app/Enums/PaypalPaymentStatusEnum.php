<?php

namespace App\Enums;

enum PaypalPaymentStatusEnum: string
{
    case CREATED = 'created';
    case IN_PROGRESS = 'inprogress';
    case PAID = 'paid';
    case EXPIRED = 'expired';
    case REJECTED = 'rejected';
}
