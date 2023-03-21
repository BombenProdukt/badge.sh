<?php

declare(strict_types=1);

namespace App\Badges\Drone\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Drone\Client;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $repo, ?string $branch = null): array
    {
        return $this->renderStatus('build', $this->client->status($user, $repo, $branch));
    }

    public function service(): string
    {
        return 'Drone';
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
            '/drone/status/{user}/{repo}/{branch?}',
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
            '/drone/status/badges/shields' => 'license',
        ];
    }
}
