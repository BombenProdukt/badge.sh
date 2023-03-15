<?php

declare(strict_types=1);

namespace App\Integrations\Memo\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

final class UpdateBadgeController extends Controller
{
    public function __invoke(Request $request, string $name): array
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
