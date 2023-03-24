<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->renderVersion(
            $tag === 'latest' ? 'npm' : "npm@{$tag}",
            $this->client->unpkg("{$package}@{$tag}/package.json")['version'],
        );
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/npm/version/{package}/{tag?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/npm/version/express'           => 'version',
            '/npm/version/yarn'              => 'version',
            '/npm/version/yarn/berry'        => 'version (tag)',
            '/npm/version/yarn/legacy'       => 'version (tag)',
            '/npm/version/@babel/core'       => 'version (scoped package)',
            '/npm/version/@nestjs/core/beta' => 'version (scoped & tag)',
        ];
    }
}
