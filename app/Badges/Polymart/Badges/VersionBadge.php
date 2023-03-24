<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId)['updates']['latest'];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/polymart/version/{resourceId}',
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
            '/polymart/version/323' => 'version',
        ];
    }
}
