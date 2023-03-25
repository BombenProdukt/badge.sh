<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FollowersBadge extends AbstractBadge
{
    protected array $routes = [
        '/modrinth/followers/{projectId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $projectId): array
    {
        return [
            'count' => $this->client->project($projectId)['followers'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('followers', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'followers',
                path: '/modrinth/followers/AANobbMI',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
