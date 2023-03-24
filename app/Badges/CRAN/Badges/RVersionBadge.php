<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RVersionBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'version' => preg_replace('/([<>=]+)\s+/', '$1', $this->client->db($package)['Depends']['R']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'R');
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/cran/r-version/{package}',
        ];
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
            '/cran/r-version/data.table' => 'r version',
        ];
    }
}
