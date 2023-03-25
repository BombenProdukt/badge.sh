<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/shardbox/license/{shard}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $shard): array
    {
        \preg_match('/opensource.org\\/licenses\\/[^>]+?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'license' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/shardbox/license/clear',
                data: $this->render([]),
            ),
        ];
    }
}
