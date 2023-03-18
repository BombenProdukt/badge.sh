<?php

declare(strict_types=1);

namespace App\Actions;

final class FormatStars
{
    public static function execute(mixed $rating, int $max = 5): string
    {
        $base     = floor((float) $rating);
        $fraction = $rating - $base;
        $full     = str_repeat('★', (int) round($fraction < 0.66 ? $base : $base + 1));
        // between 0.33 and 0.66 should be `half star` symbol
        $half = $fraction >= 0.33 && $fraction <= 0.66 ? '★' : '';

        return str_pad($full.$half, $max, '☆', STR_PAD_RIGHT);
    }
}
