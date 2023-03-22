<?php

declare(strict_types=1);

namespace App\Actions;

final class DetermineColorByGrade
{
    public static function execute(string $value): string
    {
        return match (strtoupper($value)) {
            'A+'       => 'green.700',
            'A'        => 'green.600',
            'A-'       => 'green.500',
            'B+'       => 'blue.700',
            'B'        => 'blue.600',
            'B-'       => 'blue.500',
            'C+'       => 'yellow.700',
            'C'        => 'yellow.600',
            'C-'       => 'yellow.500',
            'D+'       => 'amber.700',
            'D'        => 'amber.600',
            'D-'       => 'amber.500',
            'E+'       => 'orange.700',
            'E'        => 'orange.600',
            'E-'       => 'orange.500',
            'F'        => 'red.600',
            'R'        => 'gray.600',
            '-'        => 'gray.600',
            'BRONZE'   => 'red.600',
            'SILVER'   => 'yellow.600',
            'GOLD'     => 'blue.600',
            'PLATINUM' => 'green.600',
            default    => 'gray.600',
        };
    }
}
