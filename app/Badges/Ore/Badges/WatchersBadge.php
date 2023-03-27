<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class WatchersBadge extends AbstractBadge
{
    protected string $route = '/ore/watchers/{pluginId}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['stats'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('watchers', $properties['watchers']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'watchers',
                path: '/ore/watchers/nucleus',
                data: $this->render(['watchers' => '1000000']),
            ),
        ];
    }
}
