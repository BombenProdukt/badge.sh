<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use App\Actions\ExtractCoverageColor;
use PreemStudio\Formatter\FormatPercentage;

final class CoverageTemplate
{
    public static function make(mixed $percentage): array
    {
        return [
            'label'  => 'coverage',
            'status' => FormatPercentage::execute($percentage),
            'color'  => ExtractCoverageColor::execute($percentage),
        ];
    }
}
