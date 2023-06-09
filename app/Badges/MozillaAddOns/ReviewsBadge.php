<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ReviewsBadge extends AbstractBadge
{
    protected string $route = '/amo/reviews/{package}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'reviews',
                path: '/amo/reviews/markdown-viewer-chrome',
                data: $this->render(['rating' => '4.5']),
            ),
        ];
    }
}
