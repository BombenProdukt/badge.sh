<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class DownloadsTemplate
{
    public static function make(mixed $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute((float) $count),
            'messageColor' => 'green.600',
        ];
    }
}