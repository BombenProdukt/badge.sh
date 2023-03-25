<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/dub/rating/{package}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'rating',
            'message' => \number_format($properties['score'] / 5, 2),
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            '/dub/rating/pegged' => 'rating',
        ];
    }
}
