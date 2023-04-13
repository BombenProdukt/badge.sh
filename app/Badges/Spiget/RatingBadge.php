<?php

declare(strict_types=1);

namespace App\Badges\Spiget;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected string $route = '/spiget/rating/{resourceId}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->resource($resourceId);
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
                path: '/spiget/rating/9089',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
