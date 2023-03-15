<?php

declare(strict_types=1);

namespace App\Integrations\Actions;

final class ExtractVersionColor
{
    public static function execute(string $version): string
    {
        if (str_contains($version, 'alpha')) {
            return 'cyan.600';
        }

        if (str_contains($version, 'beta')) {
            return 'cyan.600';
        }

        if (str_contains($version, 'canary')) {
            return 'cyan.600';
        }

        if (str_contains($version, 'dev')) {
            return 'cyan.600';
        }

        if (str_contains($version, 'rc')) {
            return 'cyan.600';
        }

        if (str_starts_with($version, '0.')) {
            return 'orange.600';
        }

        return 'blue.600';
    }
}
