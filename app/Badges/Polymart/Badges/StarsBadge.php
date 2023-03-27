<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/polymart/stars/{resourceId}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId)['reviews'];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('rating', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/polymart/stars/323',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
