<?php

declare(strict_types=1);

namespace App\Actions;

final class DetermineColorByAge
{
    public static function execute(mixed $value): string
    {
        return DetermineColorByScale::execute($value, [7, 30, 180, 365, 730], true);
    }
}
