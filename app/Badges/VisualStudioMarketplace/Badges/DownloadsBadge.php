<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/vs-marketplace/downloads/{extension}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extension): array
    {
        $response = $this->client->get($extension);
        $install = collect($response['statistics'])->firstWhere('statisticName', 'install')['value'];
        $updateCount = collect($response['statistics'])->firstWhere('statisticName', 'updateCount')['value'];

        return [
            'downloads' => $install + $updateCount,
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
                name: 'downloads',
                path: '/vs-marketplace/downloads/vscodevim.vim',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
