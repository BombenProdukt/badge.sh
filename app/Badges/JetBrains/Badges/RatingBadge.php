<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/jetbrains/rating/{pluginId}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $pluginId): array
    {
        if (\is_numeric($pluginId)) {
            return [
                'rating' => $this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//rating')->text(),
            ];
        }

        return [
            'rating' => $this->client->rating($pluginId)['meanRating'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/jetbrains/rating/13441-laravel-idea',
                data: $this->render(['rating' => '4.5']),
            ),
            new BadgePreviewData(
                name: 'rating (legacy plugin)',
                path: '/jetbrains/rating/9630',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
