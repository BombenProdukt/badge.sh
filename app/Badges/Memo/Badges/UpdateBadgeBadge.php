<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final class UpdateBadgeBadge extends AbstractBadge
{
    protected array $keywords = [,
    ];

    public function handle(Request $request, string $name): array
    {
        $badge = [
            'label' => $request->input('label'),
            'message' => $request->input('message'),
            'messageColor' => $request->input('messageColor'),
        ];

        Cache::rememberForever($name, $badge);

        return $badge;
    }

    public function render(array $properties): array
    {
        return $properties;
    }

    public function routePaths(): array
    {
        return [];
    }

    public function previews(): array
    {
        return [];
    }
}
