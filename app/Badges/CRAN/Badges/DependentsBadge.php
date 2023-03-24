<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DependentsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'count' => count($this->client->db("/-/revdeps/{$package}")[$package]['Depends']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependents', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cran/dependents/{package}',
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
            '/cran/dependents/R6' => 'dependents',
        ];
    }
}
