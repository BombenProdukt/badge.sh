<?php

declare(strict_types=1);

namespace App\Badges\Flathub\Badges;

use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/flathub/downloads/{packageName}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->downloads($packageName),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/flathub/downloads/org.mozilla.firefox' => 'downloads',
        ];
    }
}
