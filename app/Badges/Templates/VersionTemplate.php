<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use App\Actions\DetermineColorByVersion;
use App\Actions\ExtractVersion;

final class VersionTemplate
{
    public static function make(string $service, string $version): array
    {
        return [
            'label'        => $service,
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => DetermineColorByVersion::execute($version),
        ];
    }
}
