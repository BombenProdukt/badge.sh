<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use App\Actions\DetermineColorByPercentage;
use PreemStudio\Formatter\FormatPercentage;

final class PercentageTemplate
{
    public static function make(string $label, mixed $percentage): array
    {
        return [
            'label'  => $label,
            'status' => FormatPercentage::execute($percentage),
            'color'  => DetermineColorByPercentage::execute($percentage),
        ];
    }
}
