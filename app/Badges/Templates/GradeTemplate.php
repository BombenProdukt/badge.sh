<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatPercentage;

final class GradeTemplate
{
    public static function make(string $label, string $value, ?string $grade = null): array
    {
        return [
            'label'       => $label,
            'status'      => is_numeric($value) ? FormatPercentage::execute($value) : $value,
            'statusColor' => [
                'A' => 'green.600',
                'B' => 'blue.600',
                'C' => 'yellow.600',
                'D' => 'amber.600',
                'E' => 'orange.600',
                'F' => 'red.600',
            ][$grade ?? $value],
        ];
    }
}
