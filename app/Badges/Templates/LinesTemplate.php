<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class LinesTemplate
{
    public static function make(int $count): array
    {
        return [
            'label'        => 'lines of code',
            'message'      => FormatNumber::execute($count),
            'messageColor' => 'blue.600',
        ];
    }
}