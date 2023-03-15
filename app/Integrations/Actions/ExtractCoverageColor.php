<?php

declare(strict_types=1);

namespace App\Integrations\Actions;

final class ExtractCoverageColor
{
    public static function execute(
        float $value,
        float $green = 100,
        float $yellow = 85,
        float $orange = 70,
        float $red = 35
    ): string {
        if ($value < $red) {
            return 'red.600';
        }

        if ($value < $orange) {
            return 'orange.600';
        }

        if ($value < $yellow) {
            return 'yellow.600';
        }

        if ($value < $green) {
            return 'blue.600';
        }

        return 'green.600';
    }
}
