<?php

declare(strict_types=1);

namespace App\Badges\Coincap\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RankBadge extends AbstractBadge
{
    protected array $routes = [
        '/coincap/rank/{assetId}',
    ];

    protected array $keywords = [
        Category::CRYPTO_CURRENCY,
    ];

    public function handle(string $assetId): array
    {
        return $this->client->get($assetId);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['name'], $properties['rank']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'price',
                path: '/coincap/rank/bitcoin',
                data: $this->render(['name' => 'bitcoin', 'rank' => 1]),
            ),
        ];
    }
}
