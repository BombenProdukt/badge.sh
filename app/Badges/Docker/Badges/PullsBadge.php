<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Docker\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class PullsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $name): array
    {
        return [
            'label'        => 'docker pulls',
            'message'      => FormatNumber::execute($this->client->info($scope, $name)['pull_count']),
            'messageColor' => 'blue.600',
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/docker/pulls/{scope}/{name}',
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
            '/docker/pulls/library/ubuntu'   => 'pulls (library)',
            '/docker/pulls/amio/node-chrome' => 'pulls (scoped)',
        ];
    }
}
