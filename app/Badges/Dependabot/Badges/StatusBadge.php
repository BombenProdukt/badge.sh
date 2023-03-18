<?php

declare(strict_types=1);

namespace App\Badges\Dependabot\Badges;

use App\Badges\Dependabot\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $identifier = null): array
    {
        $response = $this->client->get($owner, $repo, $identifier);

        return [
            'label'       => 'Dependabot',
            'status'      => $response['status'],
            'statusColor' => $response['colour'],
        ];
    }

    public function service(): string
    {
        return 'Dependabot';
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
            '/dependabot/{owner}/{repo}/{identifier?}',
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
            '/dependabot/thepracticaldev/dev.to'     => 'status',
            '/dependabot/dependabot/dependabot-core' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
