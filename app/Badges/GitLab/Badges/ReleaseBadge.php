<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ReleaseBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/latest-release/{repo:wildcard}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $repo): array
    {
        return [
            'version' => $this->client->rest($repo, 'releases')->json('0.name'),
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['version'])) {
            return [
                'label' => 'release',
                'message' => 'none',
                'messageColor' => 'yellow.600',
            ];
        }

        return $this->renderVersion($properties['version'], 'release');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'latest release',
                path: '/gitlab/latest-release/veloren/veloren',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
