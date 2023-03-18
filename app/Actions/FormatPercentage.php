<?php

declare(strict_types=1);

namespace App\Actions;

final class FormatPercentage
{
    public static function execute(mixed $value): string
    {
        return number_format((float) $value, 2).'%';
    }
}
