<?php

declare(strict_types=1);

namespace App\Badges\Steam;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CollectionSizeBadge extends AbstractBadge
{
    protected string $route = '/steam/collection-size/{collectionId}';

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $collectionId): array
    {
        return [
            'count' => \count($this->client->collection($collectionId)['children']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('size', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'collection size',
                path: '/steam/collection-size/180077636',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
