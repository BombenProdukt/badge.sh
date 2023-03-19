<?php

declare(strict_types=1);

namespace App\Actions;

use Spatie\Regex\MatchResult;
use Spatie\Regex\Regex;

final class DetermineLicense
{
    public static function execute(mixed $value): string
    {
        if (empty($value)) {
            return 'unknown';
        }

        if (is_array($value)) {
            $value = $value[0];
        }

        $value      = trim(strip_tags($value));
        $licenseIds = collect(json_decode(file_get_contents(resource_path('licenses.json')), true, JSON_THROW_ON_ERROR)['licenses'])
            ->pluck('licenseId')
            ->sortByDesc(fn (string $licenseId) => strlen($licenseId));

        if ($licenseIds->contains($value)) {
            return $value;
        }

        $expression = Regex::matchAll('/'.$licenseIds->map(fn (string $licenseId) => preg_quote($licenseId))->implode('|').'/i', $value);

        if ($expression->hasMatch()) {
            return collect($expression->results())
                ->map(fn (MatchResult $result) => $result->result())
                ->implode(' or ');
        }

        return $value;
    }
}
