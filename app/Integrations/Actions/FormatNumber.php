<?php

declare(strict_types=1);

namespace App\Integrations\Actions;

final class FormatNumber
{
    public static function execute(float $value): string
    {
        $units = ['', 'K', 'M', 'B', 'T'];

        for ($i = 0; $value >= 1000; $i++) {
            $value /= 1000;
        }

        return round($value, 1).$units[$i];
    }
}
