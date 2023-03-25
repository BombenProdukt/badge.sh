<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/greasyfork/downloads/{scriptId}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $scriptId): array
    {
        return [
            'downloads' => $this->client->get($scriptId)['total_installs'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/greasyfork/downloads/407466' => 'total downloads',
        ];
    }
}
