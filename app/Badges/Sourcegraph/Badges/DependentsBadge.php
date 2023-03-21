<?php

declare(strict_types=1);

namespace App\Badges\Sourcegraph\Badges;

use App\Badges\Sourcegraph\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DependentsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo): array
    {
        return TextTemplate::make('used by', $this->client->dependents($repo), 'green.600');
    }

    public function service(): string
    {
        return 'Sourcegraph';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/sourcegraph/dependents/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/sourcegraph/dependents/github.com/gorilla/mux' => 'dependents',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
