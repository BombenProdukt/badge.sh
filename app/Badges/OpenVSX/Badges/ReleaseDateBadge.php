<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ReleaseDateBadge extends AbstractBadge
{
    public function handle(string $extension): array
    {
        return $this->renderDate('release date', $this->client->get($extension)['timestamp']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/open-vsx/release-date/{extension}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/open-vsx/release-date/idleberg/electron-builder' => 'release date',
        ];
    }
}
