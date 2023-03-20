<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class NumberTemplate
{
    public static function make(string $label, mixed $percentage): array
    {
        return [
            'label'        => $label,
            'message'      => FormatNumber::execute($percentage),
            'messageColor' => 'green.600',
        ];
    }
}
