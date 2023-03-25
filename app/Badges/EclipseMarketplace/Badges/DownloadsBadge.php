<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/eclipse-marketplace/downloads/{name}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $name): array
    {
        return [
            'downloads' => $this->client->get($name)->filterXPath('//installstotal')->text(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/eclipse-marketplace/downloads/notepad4e' => 'total downloads',
        ];
    }
}
