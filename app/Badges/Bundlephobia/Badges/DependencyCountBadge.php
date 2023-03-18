<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Badges\Bundlephobia\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class DependencyCountBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        return [
            'label'       => 'dependency count',
            'status'      => (string) $this->client->get($name)['dependencyCount'],
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Bundlephobia';
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
            '/bundlephobia/dependency-count/{name}',
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
        $route->where('name', '.+');
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
            '/bundlephobia/dependency-count/react' => 'dependency count',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
