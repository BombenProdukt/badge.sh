<?php

declare(strict_types=1);

namespace App\Integrations\Badge\Controllers;

use App\Integrations\AbstractController;

final class BadgeController extends AbstractController
{
    protected function handleRequest(string $label, string $status, ?string $statusColor = null): array
    {
        return [
            'label'       => $label,
            'status'      => $status,
            'statusColor' => $statusColor ?? 'green.600',
        ];
    }
}
