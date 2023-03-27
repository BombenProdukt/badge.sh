<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RankBadge extends AbstractBadge
{
    protected string $route = '/jsdelivr/rank/{platform}/{package:wildcard}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $platform, string $package): array
    {
        return $this->client->data($platform, $package);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'jsDelivr rank',
            'message' => $properties['rank'] ? '#'.$properties['rank'] : 'none',
            'messageColor' => $properties['rank'] ? 'blue.600' : 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rank',
                path: '/jsdelivr/rank/npm/lodash',
                data: $this->render(['rank' => 1]),
            ),
        ];
    }
}
