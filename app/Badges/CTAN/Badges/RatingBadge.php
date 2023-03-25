<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/ctan/rating/{package}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        \preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'rating' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'rating',
            'message' => \number_format((float) $properties['rating'], 2).'/5',
            'messageColor' => 'green.600',
        ];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/ctan/rating/pgf-pie' => 'rating',
        ];
    }
}
