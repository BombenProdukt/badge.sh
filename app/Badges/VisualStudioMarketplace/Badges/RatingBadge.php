<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/vs-marketplace/rating/{extension}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $extension): array
    {
        $response = collect($this->client->get($extension));

        return [
            'rating' => collect($response['statistics'])->firstWhere('statisticName', 'averagerating')['value'],
            'count' => collect($response['statistics'])->firstWhere('statisticName', 'ratingcount')['value'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'rating',
            'message' => \number_format((float) $properties['rating']).'/5 ('.$properties['count'].')',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/vs-marketplace/rating/vscodevim.vim',
                data: $this->render(['rating' => '4.5', 'count' => '100']),
            ),
        ];
    }
}
