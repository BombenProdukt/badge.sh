<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/pypi/version/{project}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project): array
    {
        return $this->client->get($project)['info'];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/pypi/version/pip',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/pypi/version/docutils',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
