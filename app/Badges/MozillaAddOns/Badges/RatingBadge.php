<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/amo/rating/{package}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package)['ratings'];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/amo/rating/markdown-viewer-chrome',
                data: $this->render(['count' => '4']),
            ),
        ];
    }
}
