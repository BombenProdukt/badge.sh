<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PopularityBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/popularity/{package}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package): array
    {
        return [
            'popularity' => $this->client->api("packages/{$package}/score")['popularityScore'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('popularity', $properties['popularity'] * 100);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'popularity',
                path: '/pub/popularity/mobx',
                data: $this->render(['popularity' => 0.0]),
            ),
        ];
    }
}
