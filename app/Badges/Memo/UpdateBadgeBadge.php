<?php

declare(strict_types=1);

namespace App\Badges\Memo;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

final class UpdateBadgeBadge extends Controller
{
    public function __invoke(Request $request, string $name): Response
    {
        $badge = [
            'label' => $request->input('label'),
            'message' => $request->input('message'),
            'messageColor' => $request->input('messageColor'),
        ];

        Cache::rememberForever($name, $badge);

        return response()->noContent();
    }
}
