<?php

declare(strict_types=1);

namespace App\Actions;

use InvalidArgumentException;
use RuntimeException;

final class DetermineColorByScale
{
    private static array $defaultColors = [
        1 => ['red.600', 'green.600'],
        2 => ['red.600', 'yellow.600', 'green.600'],
        3 => ['red.600', 'yellow.600', 'blue.600', 'green.600'],
        4 => ['red.600', 'orange.600', 'amber.600', 'blue.600', 'green.600'],
        5 => ['red.600', 'orange.600', 'amber.600', 'yellow.600', 'blue.600', 'green.600'],
    ];

    public static function execute(mixed $value, array $steps, bool $reversed = false)
    {
        if ($steps === null) {
            throw new InvalidArgumentException('When invoking colorScale, steps should be provided.');
        }

        if (! count(self::$defaultColors[count($steps)])) {
            throw new RuntimeException('No default colors for '.count($steps).' steps.');
        }

        $colors = self::$defaultColors[count($steps)];

        if (count($steps) !== count($colors) - 1) {
            throw new RuntimeException('When colors are provided, there should be n + 1 colors for n steps.');
        }

        if ($reversed) {
            $colors = array_reverse($colors);
        }

        return array_slice($colors, array_search(true, array_map(fn ($step) => $value < $step, $steps)))[0];
    }
}
