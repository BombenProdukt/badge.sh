<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DependentsBadge extends AbstractBadge
{
    public function handle(string $distribution): array
    {
        return [
            'count' => $this->client->get("reverse_dependencies/dist/{$distribution}")['total'],
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
            '/cpan/dependents/{distribution}',
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
            '/cpan/dependents/DateTime' => 'dependents',
        ];
    }
}
