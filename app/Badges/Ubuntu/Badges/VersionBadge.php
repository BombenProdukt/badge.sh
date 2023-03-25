<?php

declare(strict_types=1);

namespace App\Badges\Ubuntu\Badges;

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
        '/ubuntu/version/{packageName}/{series?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName, ?string $series = null): array
    {
        return [
            'version' => $this->client->version($packageName, $series),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
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
            '/ubuntu/version/ubuntu-wallpapers' => 'version',
            '/ubuntu/version/ubuntu-wallpapers/bionic' => 'version',
        ];
    }
}
