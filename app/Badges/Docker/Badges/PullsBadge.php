<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Actions\FormatNumber;
use App\Badges\Docker\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class PullsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $name): array
    {
        return [
            'label'       => 'docker pulls',
            'status'      => FormatNumber::execute($this->client->info($scope, $name)['pull_count']),
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Docker';
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
            '/docker/pulls/{scope}/{name}',
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
        //
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
            '/docker/pulls/library/ubuntu'   => 'pulls (library)',
            '/docker/pulls/amio/node-chrome' => 'pulls (scoped)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
