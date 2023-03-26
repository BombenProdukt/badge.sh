<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ReviewsBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/reviews/{extension:wildcard}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $extension): array
    {
        return [
            'count' => $this->client->get($extension)['reviewCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('reviews', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'reviews',
                path: '/open-vsx/reviews/idleberg/electron-builder',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
