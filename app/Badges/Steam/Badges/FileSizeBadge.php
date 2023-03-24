<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FileSizeBadge extends AbstractBadge
{
    public function handle(string $fileId): array
    {
        return [
            'size' => $this->client->file($fileId)['file_size'],
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
            '/steam/file-size/{fileId}',
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
            '/steam/file-size/100' => 'file size',
        ];
    }
}
