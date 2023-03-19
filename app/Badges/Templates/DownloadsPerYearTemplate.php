<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class DownloadsPerYearTemplate
{
    public static function make(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/year',
            'messageColor' => 'green.600',
        ];
    }
}
