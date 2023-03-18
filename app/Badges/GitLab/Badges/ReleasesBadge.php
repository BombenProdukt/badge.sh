<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Actions\FormatNumber;
use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ReleasesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = $this->client->rest($owner, $repo, 'releases');

        return [
            'label'       => 'releases',
            'status'      => FormatNumber::execute((int) $response->header('x-total')),
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
            '/gitlab/releases/{owner}/{repo}',
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
            '/gitlab/releases/AuroraOSS/AuroraStore' => 'release',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
