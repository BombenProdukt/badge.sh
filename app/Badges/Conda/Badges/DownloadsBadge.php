<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/conda/downloads/{channel}/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $channel, string $package): array
    {
        return [
            'downloads' => collect($this->client->get($channel, $package)['files'])->sum('ndownloads'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: '',
                path: '/conda/downloads/conda-forge/python',
                data: $this->render([]),
            ),
        ];
    }
}
