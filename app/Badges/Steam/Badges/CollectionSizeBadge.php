<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CollectionSizeBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/steam/collection-size/{collectionId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
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
