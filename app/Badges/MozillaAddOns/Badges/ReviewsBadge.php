<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Enums\Category;

final class ReviewsBadge extends AbstractBadge
{
    protected array $routes = [
        '/amo/reviews/{package}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package): array
    {
        return [
            'rating' => $this->client->get($package)['ratings']['average'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['rating']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/amo/reviews/markdown-viewer-chrome' => 'reviews',
        ];
    }
}
