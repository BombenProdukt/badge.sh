<?php

declare(strict_types=1);

namespace App\Badges\Templates;

final class StatusTemplate
{
    public static function make(string $service, string $status): array
    {
        return [
            'label'        => $service,
            'message'      => $status,
            'messageColor' => 'TODO',
        ];
    }
}
