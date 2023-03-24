<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SpongeVersionBadge extends AbstractBadge
{
    public function handle(string $pluginId): array
    {
        return $this->renderVersion(
            collect($this->client->get($pluginId)['promoted_versions'])
                ->flatMap(fn (array $version) => $version['tags'])
                ->filter(fn (array $tag) => strtolower($tag['name']) === 'sponge')
                ->map(fn (array $tag) => $tag['display_data'])
                ->first()
        );
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/ore/sponge-version/{pluginId}',
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
            '/ore/sponge-version/nucleus' => 'sponge version',
        ];
    }
}
