<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SizeBadge extends AbstractBadge
{
    public function handle(string $appId): array
    {
        return $this->client->get($appId);
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/winget/size/{appId}',
        ];
    }

    public function routeParameters(): array
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
        return [
            '/winget/size/GitHub.cli' => 'size',
        ];
    }
}
