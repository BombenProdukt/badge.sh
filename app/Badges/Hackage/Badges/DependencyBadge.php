<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class DependencyBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/hackage/dependencies/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $package): array
    {
        $client = Http::baseUrl('https://packdeps.haskellers.com/')->throw();
        $client->get("licenses/{$package}");

        return [
            'outdated' => \str_contains($client->get("feed/{$package}")->body(), "Outdated dependencies for {$package}"),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('dependencies', $properties['outdated'] ? 'outdated' : 'up-to-date', $properties['outdated'] ? 'red.600' : 'green.600');
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
            '/hackage/dependencies/Cabal' => 'dependencies',
        ];
    }
}
