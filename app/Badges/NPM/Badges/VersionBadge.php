<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/version/{package}/{tag?}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'package' => $package,
            'tag' => $tag,
            'version' => $this->client->unpkg("{$package}@{$tag}/package.json"),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion(
            $properties['tag'] === 'latest' ? 'npm' : 'npm@'.$properties['tag'],
            $properties['version'],
        );
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/npm/version/express',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/npm/version/yarn',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (tag)',
                path: '/npm/version/yarn/berry',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (tag)',
                path: '/npm/version/yarn/legacy',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (scoped package)',
                path: '/npm/version/@babel/core',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (scoped & tag)',
                path: '/npm/version/@nestjs/core/beta',
                data: $this->render([]),
            ),
        ];
    }
}
