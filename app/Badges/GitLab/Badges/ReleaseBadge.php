<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ReleaseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = $this->client->rest($owner, $repo, 'releases')->json(0);

        if (empty($response)) {
            return [
                'label'       => 'release',
                'status'      => 'none',
                'statusColor' => 'yellow.600',
            ];
        }

        return [
            'label'       => 'release',
            'status'      => $response['name'],
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'GitLab';
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
            '/gitlab/release/{owner}/{repo}',
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
            '/gitlab/release/veloren/veloren' => 'latest release',

        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
