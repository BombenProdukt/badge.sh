<?php

declare(strict_types=1);

namespace App\Badges\Ore;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/ore/stars/{pluginId}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $pluginId): array
    {
        return $this->client->get($pluginId)['stats'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/ore/stars/nucleus',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
