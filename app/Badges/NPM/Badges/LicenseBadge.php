<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/license/{package}/{tag?}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->client->unpkg("{$package}@{$tag}/package.json");
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
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
