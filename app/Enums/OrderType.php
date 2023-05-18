<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderType: string
{
    case REGISTRATION = '0';

    case SERVICE = '1';

    case PRODUCT = '2';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
