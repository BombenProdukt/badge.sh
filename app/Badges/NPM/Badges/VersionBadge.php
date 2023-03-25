<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/npm/version/{package}/{tag?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/npm/version/express' => 'version',
            '/npm/version/yarn' => 'version',
            '/npm/version/yarn/berry' => 'version (tag)',
            '/npm/version/yarn/legacy' => 'version (tag)',
            '/npm/version/@babel/core' => 'version (scoped package)',
            '/npm/version/@nestjs/core/beta' => 'version (scoped & tag)',
        ];
    }
}
