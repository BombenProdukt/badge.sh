<?php

declare(strict_types=1);

namespace App\Actions;

final class DetermineColorByVersion
{
    public static function execute(string $value): string
    {
        if (str_contains($value, 'alpha')) {
            return 'cyan.600';
        }

        if (str_contains($value, 'beta')) {
            return 'cyan.600';
        }

        if (str_contains($value, 'canary')) {
            return 'cyan.600';
        }

        if (str_contains($value, 'dev')) {
            return 'cyan.600';
        }

        if (str_contains($value, 'rc')) {
            return 'cyan.600';
        }

        if (str_starts_with($value, '0.')) {
            return 'orange.600';
        }

        return 'blue.600';
    }
}
