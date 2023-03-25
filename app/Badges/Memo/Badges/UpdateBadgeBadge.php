<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;

final class UpdateBadgeBadge extends AbstractBadge
{
    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [];
    }
}
