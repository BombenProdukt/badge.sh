<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CrystalBadge extends AbstractBadge
{
    protected array $routes = [
        '/shardbox/crystal-version/{shard}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $shard): array
    {
        \preg_match('/Crystal<\\/span>\\s*<span[^>]*?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'version' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'crystal',
            'message' => \html_entity_decode($properties['version']),
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'crystal version',
                path: '/shardbox/crystal-version/amber',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
