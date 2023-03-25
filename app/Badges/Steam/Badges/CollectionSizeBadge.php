<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;

final class CollectionSizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/steam/collection-size/{collectionId}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/steam/collection-size/180077636' => 'collection size',
        ];
    }
}
