<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected string $route = '/wordpress/{extensionType:plugin,theme}/rating/{extension}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return $this->client->info($extensionType, $extension);
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating (plugin)',
                path: '/wordpress/plugin/rating/bbpress',
                data: $this->render(['rating' => '4.5']),
            ),
            new BadgePreviewData(
                name: 'rating (theme)',
                path: '/wordpress/theme/rating/twentyseventeen',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
