<?php

declare(strict_types=1);

namespace App\Badges\Ore\Badges;

use App\Enums\Category;

final class LastModifiedBadge extends AbstractBadge
{
    protected array $routes = [
        '/ore/last-modified/{pluginId}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $pluginId): array
    {
        return [
            'date' => $this->client->get($pluginId)['last_updated'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last modified', $properties['date']);
    }

    public function previews(): array
    {
        return [
            '/ore/last-modified/nucleus' => 'license',
        ];
    }
}
