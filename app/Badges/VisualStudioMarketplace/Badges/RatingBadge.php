<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

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
            'message' => \number_format($properties['rating']).'/5 ('.$properties['count'].')',
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            '/vs-marketplace/rating/vscodevim.vim' => 'rating',
        ];
    }
}
