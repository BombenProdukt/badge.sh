<?php

declare(strict_types=1);

namespace App\Actions;

use Spatie\Regex\Regex;

final class DetermineColorByVersion
{
    public static function execute(string $value): string
    {
        $expression = Regex::match('/alpha|beta|canary|dev|pre|rc|snapshot/', $value);

        if ($expression->hasMatch()) {
            return 'cyan.600';
        }

        if (str_starts_with($value, '0.')) {
            return 'orange.600';
        }

        return 'blue.600';
    }
}
