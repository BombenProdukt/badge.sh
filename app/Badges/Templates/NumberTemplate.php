<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class NumberTemplate
{
    public static function make(string $label, mixed $value): array
    {
        return [
            'label'        => $label,
            'message'      => FormatNumber::execute((float) $value),
            'messageColor' => 'green.600',
        ];
    }
}
