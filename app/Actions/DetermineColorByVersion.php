<?php

declare(strict_types=1);

namespace App\Actions;

use Spatie\Regex\Regex;

final class DetermineColorByVersion
{
    public static function execute(string $value): string
    {
        $stableRelease = Regex::match('/mature|production|stable/i', $value);

        if ($stableRelease->hasMatch()) {
            return 'green.600';
        }

        $preRelease = Regex::match('/alpha|beta|canary|dev|pre|rc|snapshot/i', $value);

        if ($preRelease->hasMatch()) {
            return 'cyan.600';
        }

        $badState = Regex::match('/inactive|planning/i', $value);

        if ($badState->hasMatch()) {
            return 'red.600';
        }

        if (\str_starts_with($value, '0.')) {
            return 'orange.600';
        }

        return 'blue.600';
    }
}
