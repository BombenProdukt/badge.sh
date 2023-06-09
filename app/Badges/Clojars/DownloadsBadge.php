<?php

declare(strict_types=1);

namespace App\Badges\Clojars;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/clojars/downloads/{clojar}';

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
            new BadgePreviewData(
                name: 'total downlodas',
                path: '/clojars/downloads/prismic',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
