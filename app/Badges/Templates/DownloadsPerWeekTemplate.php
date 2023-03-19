<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use PreemStudio\Formatter\FormatNumber;

final class DownloadsPerWeekTemplate
{
    public static function make(int $count): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($count).'/week',
            'messageColor' => 'green.600',
        ];
    }
}
