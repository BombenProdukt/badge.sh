<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Actions\FormatNumber;
use App\Badges\CodeClimate\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class IssuesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');

        return [
            'label'       => 'issues',
            'status'      => FormatNumber::execute($response['meta']['issues_count']),
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Code Climate';
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
            '/codeclimate/issues/{owner}/{repo}',
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
            '/codeclimate/issues/codeclimate/codeclimate' => 'issues',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
