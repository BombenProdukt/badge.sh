<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/jetbrains/downloads/{pluginId}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $pluginId): array
    {
        if (\is_numeric($pluginId)) {
            return [
                'downloads' => $this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//@downloads')->text(),
            ];
        }

        return $this->client->info($pluginId);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'downloads',
                path: '/jetbrains/downloads/13441-laravel-idea',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'downloads (legacy plugin)',
                path: '/jetbrains/downloads/9630',
                data: $this->render([]),
            ),
        ];
    }
}
