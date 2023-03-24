<?php

declare(strict_types=1);

namespace App\Badges\Drone\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $user, string $repo, ?string $branch = null): array
    {
        return [
            'status' => $this->client->status($user, $repo, $branch),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build', $properties['status']);
    }

    public function keywords(): array
    {
        return [Category::BUILD];
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
