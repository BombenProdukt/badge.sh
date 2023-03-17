<?php

declare(strict_types=1);

namespace App\Integrations\Memo\Controllers;

use App\Integrations\AbstractController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class UpdateBadgeController extends AbstractController
{
    protected function handleRequest(Request $request, string $name): array
    {
        $badge = [
            'label'       => $request->input('label'),
            'status'      => $request->input('status'),
            'statusColor' => $request->input('statusColor'),
        ];

        Cache::rememberForever($name, $badge);

        return $badge;
    }
}
