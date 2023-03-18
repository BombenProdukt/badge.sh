<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Actions\FormatNumber;
use App\Badges\NPM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class DependentsWithScopeBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $package, string $tag = 'latest'): array
    {
        $response = $this->client->web("package/{$scope}/{$package}");

        preg_match('/"dependentsCount"\s*:\s*(\d+)/', $response, $matches);

        return [
            'label'       => 'dependents',
            'status'      => FormatNumber::execute((int) $matches[1]),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'npm';
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
            '/npm/dependents/{scope}/{package}/{tag?}',
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
        $route->where('scope', '@[a-z]+');
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
            '/npm/dependents/got' => 'dependents',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
