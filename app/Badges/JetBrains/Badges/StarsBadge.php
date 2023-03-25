<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/jetbrains/stars/{pluginId}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $pluginId): array
    {
        if (\is_numeric($pluginId)) {
            return [
                'stars' => $this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//rating')->text(),
            ];
        }

        return [
            'stars' => $this->client->rating($pluginId)['meanRating'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/jetbrains/stars/13441-laravel-idea',
                data: $this->render(['stars' => '4.5']),
            ),
            new BadgePreviewData(
                name: 'stars (legacy plugin)',
                path: '/jetbrains/stars/9630',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
