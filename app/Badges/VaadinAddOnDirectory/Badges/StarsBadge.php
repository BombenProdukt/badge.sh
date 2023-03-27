<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/vaadin/stars/{packageName}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $packageName): array
    {
        return [
            'stars' => $this->client->get($packageName)['averageRating'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/vaadin/stars/vaadinvaadin-grid',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
