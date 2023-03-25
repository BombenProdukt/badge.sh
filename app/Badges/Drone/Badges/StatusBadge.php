<?php

declare(strict_types=1);

namespace App\Badges\Drone\Badges;

use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/drone/status/{user}/{repo}/{branch?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

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

    public function previews(): array
    {
        return [
            '/drone/status/badges/shields' => 'license',
        ];
    }
}
