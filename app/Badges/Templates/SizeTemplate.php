<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatBytes;

final class SizeTemplate
{
    public static function make(int $count): array
    {
        return [
            'label'        => 'size',
            'message'      => FormatBytes::execute($count),
            'messageColor' => 'blue.600',
        ];
    }
}
