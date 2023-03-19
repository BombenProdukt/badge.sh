<?php

declare(strict_types=1);

namespace App\Badges\AppVeyor\Badges;

use App\Badges\AppVeyor\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $account, string $project, ?string $branch = null): array
    {
        $branch = $branch ? "/branch/{$branch}" : '';
        $status = $this->client->get($account, $project, $branch)['build']['status'];

        return [
            'label'       => 'appveyor',
            'status'      => $status,
            'statusColor' => $status === 'success' ? 'green.600' : 'red.600',
        ];
    }

    public function service(): string
    {
        return 'AppVeyor';
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
            '/appveyor/{account}/{project}/status/{branch?}',
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
            '/appveyor/gruntjs/grunt/status'           => 'build',
            '/appveyor/gruntjs/grunt/status/deprecate' => 'build (branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
