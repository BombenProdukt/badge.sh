<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use Carbon\Carbon;

final class DateTimeTemplate
{
    public static function make(string $label, mixed $percentage): array
    {
        return [
            'label'        => $label,
            'message'      => Carbon::parse($percentage)->toDateTimeString(),
            'messageColor' => 'green.600',
        ];
    }
}
