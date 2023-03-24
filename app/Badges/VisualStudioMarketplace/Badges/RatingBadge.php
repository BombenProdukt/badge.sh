<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $extension): array
    {
        $response = collect($this->client->get($extension));

        return [
            'rating' => collect($response['statistics'])->firstWhere('statisticName', 'averagerating')['value'],
            'count'  => collect($response['statistics'])->firstWhere('statisticName', 'ratingcount')['value'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'rating',
            'message'      => number_format($properties['rating']).'/5 ('.$properties['count'].')',
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/rating/{extension}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/vs-marketplace/rating/vscodevim.vim' => 'rating',
        ];
    }
}
