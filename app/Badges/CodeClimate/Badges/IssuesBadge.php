<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Badges\CodeClimate\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class IssuesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        $response = $this->client->get($project, 'snapshots');

        return [
            'label'        => 'issues',
            'message'      => FormatNumber::execute($response['meta']['issues_count']),
            'messageColor' => 'blue.600',
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
            '/codeclimate/issues/{project}',
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
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
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
