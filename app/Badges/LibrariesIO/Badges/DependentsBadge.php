<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Badges\AbstractBadge;
use App\Badges\LibrariesIO\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $platform, string $package): array
    {
        return $this->renderNumber('dependents', $this->client->get($platform, $package)['dependents_count']);
    }

    public function service(): string
    {
        return 'Libraries.io';
    }

    public function keywords(): array
    {
        return [Category::DEPENDENCIES];
    }

    public function routePaths(): array
    {
        return [
            '/libraries-io/dependents/{platform}/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/libraries-io/dependents/npm/got'         => 'dependents',
            '/libraries-io/dependents/npm/@babel/core' => 'dependents (scoped)',
        ];
    }
}
