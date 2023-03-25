<?php

declare(strict_types=1);

namespace App\Badges\Debian\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/debian/version/{packageName}/{distribution?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName, ?string $distribution = 'stable'): array
    {
        return [
            'version' => \array_key_first($this->client->version($packageName, $distribution)),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
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
            '/debian/version/apt' => 'version',
            '/debian/version/apt/unstable' => 'version',
        ];
    }
}
