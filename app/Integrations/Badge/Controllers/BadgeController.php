<?php

declare(strict_types=1);

namespace App\Integrations\Badge\Controllers;

use Illuminate\Routing\Controller;

final class BadgeController extends Controller
{
    public function __invoke(string $label, string $status, ?string $statusColor = null): array
    {
        return [
            'label'       => $label,
            'status'      => $status,
            'statusColor' => $statusColor ?? 'green.600',
        ];
    }
}
