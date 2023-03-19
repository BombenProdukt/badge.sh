<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class DownloadsPerDayTemplate
{
    public static function make(int $count): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($count).'/day',
            'statusColor' => 'green.600',
        ];
    }
}
