<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    public function handle(string $pluginId): array
    {
        return $this->renderDateDiff('last modified', $this->client->get($pluginId)['last_updated']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/ore/last-modified/{pluginId}',
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
            '/ore/last-modified/nucleus' => 'license',
        ];
    }
}
