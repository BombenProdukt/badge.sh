<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/shardbox/version/{shard}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $shard): array
    {
        \preg_match('/class="version">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'version' => $matches[1],
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
                path: '/shardbox/version/kemal',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
