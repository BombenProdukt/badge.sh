<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO\Badges;

use App\Badges\AbstractBadge;
use App\Badges\LibrariesIO\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentRepositoriesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $platform, string $package): array
    {
        return $this->renderNumber('dependent repositories', $this->client->get($platform, $package)['dependent_repos_count']);
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
            '/libraries-io/dependent-repositories/{platform}/{package}',
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
            '/libraries-io/dependent-repositories/npm/got'         => 'dependent repositories',
            '/libraries-io/dependent-repositories/npm/@babel/core' => 'dependent repositories (scoped)',
        ];
    }
}
