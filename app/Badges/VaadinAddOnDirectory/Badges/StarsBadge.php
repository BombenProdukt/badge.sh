<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/vaadin/stars/{packageName}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $packageName): array
    {
        return [
            'rating' => $this->client->get($packageName)['averageRating'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('rating', $properties['rating']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: '',
                path: '/vaadin/stars/vaadinvaadin-grid',
                data: $this->render([]),
            ),
        ];
    }
}
