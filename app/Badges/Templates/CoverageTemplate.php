<?php

declare(strict_types=1);

namespace App\Badges\Templates;

final class CoverageTemplate
{
    public static function make(mixed $percentage): array
    {
        return PercentageTemplate::make('coverage', $percentage);
    }
}
