<?php

declare(strict_types=1);

namespace App\Integrations\Actions;

final class ExtractVersion
{
    public static function execute(string $version): string
    {
        if (empty($version)) {
            return 'unknown';
        }

        if (substr($version, 0, 1) === 'v') {
            return $version;
        }

        return "v{$version}";
    }
}
