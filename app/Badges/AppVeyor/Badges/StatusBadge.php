<?php

declare(strict_types=1);

namespace App\Badges\AppVeyor\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AppVeyor\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
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
            'label'        => 'appveyor',
            'message'      => $status,
            'messageColor' => $status === 'success' ? 'green.600' : 'red.600',
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
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/appveyor/status/{account}/{project}/{branch?}',
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
            '/appveyor/status/gruntjs/grunt'           => 'build',
            '/appveyor/status/gruntjs/grunt/deprecate' => 'build (branch)',
        ];
    }
}
