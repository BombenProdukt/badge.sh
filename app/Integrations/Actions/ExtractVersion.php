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

        $firstChar = substr($version, 0, 1);

        if ($firstChar === 'v' || blank($firstChar, 10)) {
            return $version;
        }

        return "v{$version}";
    }
}
