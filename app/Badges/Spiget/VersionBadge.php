<?php

declare(strict_types=1);

namespace App\Badges\Spiget;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/spiget/version/{resourceId}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $resourceId): array
    {
        return [
            'version' => $this->client->latestVersion($resourceId)['name'],
        ];
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
                path: '/spiget/version/9089',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
