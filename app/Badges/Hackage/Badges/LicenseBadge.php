<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/hackage/license/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        return $this->client->hackage($package);
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
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
            '/hackage/license/Cabal' => 'license',
        ];
    }
}
