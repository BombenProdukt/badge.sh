<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected string $route = '/polymart/rating/{resourceId}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId)['reviews'];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('rating', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/polymart/rating/323',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
