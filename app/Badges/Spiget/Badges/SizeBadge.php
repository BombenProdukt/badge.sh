<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SizeBadge extends AbstractBadge
{
    public function handle(string $resourceId): array
    {
        $file = $this->client->resource($resourceId)['file'];

        if ($file['type'] === 'external') {
            return [
                'size' => 'resource hosted externally',
            ];
        }

        return [
            'size' => $file['size'].' '.$file['sizeUnit'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/spiget/size/{resourceId}',
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
            '/spiget/size/9089' => 'size',
        ];
    }
}
