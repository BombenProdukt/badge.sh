<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;

final class VersionTemplate
{
    public static function make(string $service, string $version): array
    {
        return [
            'label'        => $service,
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
