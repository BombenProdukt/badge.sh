<?php

declare(strict_types=1);

namespace App\Badges\Clojars\Badges;

use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/clojars/downloads/{clojar}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $clojar): array
    {
        return $this->client->get($clojar);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/clojars/downloads/prismic' => 'total downlodas',
        ];
    }
}
