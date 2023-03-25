<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/vaadin/rating-count/vaadinvaadin-grid' => 'rating count',
        ];
    }
}
