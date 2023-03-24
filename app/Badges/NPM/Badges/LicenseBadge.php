<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->renderLicense($this->client->unpkg("{$package}@{$tag}/package.json")['license']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/npm/license/{package}/{tag?}',
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
            '/npm/license/lodash' => 'license',
        ];
    }
}
