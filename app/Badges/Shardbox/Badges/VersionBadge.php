<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $shard): array
    {
        preg_match('/class="version">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return $this->renderVersion($matches[1]);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/shardbox/version/{shard}',
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
            '/shardbox/version/kemal' => 'version',
        ];
    }
}
