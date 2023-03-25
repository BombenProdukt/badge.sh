<?php

declare(strict_types=1);

namespace App\Badges\Node\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class VersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/node/version/{package}/{tag?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package, ?string $tag = 'latest'): array
    {
        return [
            'package' => $package,
            'tag' => $tag,
            'version' => Arr::get($this->client->get($package, $tag, $this->getRequestData('registry')), 'engines.node'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion(
            $properties['tag'] === 'latest' ? $properties['package'] : $properties['package'].'@'.$properties['tag'],
            $properties['version'],
        );
    }

    public function routeRules(): array
    {
        return [
            'registry' => ['nullable', 'url'],
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
            '/node/version/passport' => 'node version',
            '/node/version/passport/latest' => 'node version (tag)',
            '/node/version/passport/latest?registry=https://registry.npmjs.com' => 'node version (tag, custom registry)',
            '/node/version/@stdlib/stdlib' => 'node version (scoped)',
            '/node/version/@stdlib/stdlib/latest' => 'node version (scoped, tag)',
            '/node/version/@stdlib/stdlib/latest?registry=https://registry.npmjs.com' => 'node version (scoped, tag, custom registry)',
        ];
    }
}
