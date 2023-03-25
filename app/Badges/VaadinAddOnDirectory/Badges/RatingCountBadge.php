<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/vaadin/rating-count/{packageName}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $packageName): array
    {
        return [
            'count' => $this->client->get($packageName)['ratingCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('rating count', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating count',
                path: '/vaadin/rating-count/vaadinvaadin-grid',
                data: $this->render([]),
            ),
        ];
    }
}
