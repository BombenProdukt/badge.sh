<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class DownloadsPerYearTemplate
{
    public static function make(int $count): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($count).'/year',
            'statusColor' => 'green.600',
        ];
    }
}
