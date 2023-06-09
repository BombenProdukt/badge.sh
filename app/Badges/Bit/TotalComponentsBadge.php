<?php

declare(strict_types=1);

namespace App\Badges\Bit;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TotalComponentsBadge extends AbstractBadge
{
    protected string $route = '/bit/components/{collection:wildcard}';

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $collection): array
    {
        return [
            'count' => $this->client->get($collection)['totalComponents'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('components', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'total components',
                path: '/bit/components/ramda/ramda',
                data: $this->render(['count' => '100']),
            ),
        ];
    }
}
