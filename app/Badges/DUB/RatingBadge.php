<?php

declare(strict_types=1);

namespace App\Badges\DUB;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected string $route = '/dub/rating/{package}';

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
            new BadgePreviewData(
                name: 'rating',
                path: '/dub/rating/pegged',
                data: $this->render(['score' => '4.5']),
            ),
        ];
    }
}
