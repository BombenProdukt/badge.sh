<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class DownloadsPerWeekTemplate
{
    public static function make(int $count): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($count).'/week',
            'statusColor' => 'green.600',
        ];
    }
}
