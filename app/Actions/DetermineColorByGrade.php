<?php

declare(strict_types=1);

namespace App\Actions;

final class DetermineColorByGrade
{
    public static function execute(string $value): string
    {
        return [
            'A+' => 'green.600',
            'A'  => 'green.600',
            'B'  => 'blue.600',
            'C'  => 'yellow.600',
            'D'  => 'amber.600',
            'E'  => 'orange.600',
            'F'  => 'red.600',
            'R'  => 'blue.600',
        ][$value];
    }
}
