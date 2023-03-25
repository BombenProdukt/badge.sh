<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/dub/downloads-monthly/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerMonth($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/dub/downloads-monthly/vibe-d' => 'monthly downloads',
        ];
    }
}
