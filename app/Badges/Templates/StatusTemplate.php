<?php

declare(strict_types=1);

namespace App\Badges\Templates;

use App\Actions\DetermineColorByStatus;

final class StatusTemplate
{
    public static function make(string $service, string $status): array
    {
        return [
            'label'        => strtolower($service),
            'message'      => $status,
            'messageColor' => DetermineColorByStatus::execute($status),
        ];
    }
}
