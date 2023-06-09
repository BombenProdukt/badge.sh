<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected string $route = '/open-vsx/rating/{extension:wildcard}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $extension): array
    {
        $response = $this->client->get($extension);

        return [
            'rating' => $response['averageRating'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'rating',
            'message' => $properties['rating'].'/5',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/open-vsx/rating/idleberg/electron-builder',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
