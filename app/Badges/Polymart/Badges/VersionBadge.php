<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/polymart/version/{resourceId}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId)['updates']['latest'];
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
                path: '/polymart/version/323',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
