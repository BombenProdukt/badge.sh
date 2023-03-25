<?php

declare(strict_types=1);

namespace App\Badges\Drone\Badges;

use App\Data\BadgePreviewData;
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
            new BadgePreviewData(
                name: 'license',
                path: '/drone/status/badges/shields',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
