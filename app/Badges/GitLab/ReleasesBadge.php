<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ReleasesBadge extends AbstractBadge
{
    protected string $route = '/gitlab/releases/{repo:wildcard}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'releases')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('releases', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'release',
                path: '/gitlab/releases/AuroraOSS/AuroraStore',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
