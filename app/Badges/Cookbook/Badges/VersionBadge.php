<?php

declare(strict_types=1);

namespace App\Badges\Cookbook\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $cookbook): array
    {
        return $this->renderVersion($this->client->version($cookbook));
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/cookbook/version/{cookbook}',
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
            '/cookbook/version/chef-sugar' => 'version',
        ];
    }
}
