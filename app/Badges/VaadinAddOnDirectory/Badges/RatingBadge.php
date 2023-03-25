<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/vaadin/rating/{packageName}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $packageName): array
    {
        return [
            'rating' => $this->client->get($packageName)['averageRating'],
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
                path: '/vaadin/rating/vaadinvaadin-grid',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
