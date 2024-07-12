<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderType extends Enum
{
    const SHOPPING =   'SHOPPING';
    const PRESCRIPTION = 'PRESCRIPTION';
}
