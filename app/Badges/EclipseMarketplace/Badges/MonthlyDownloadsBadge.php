<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/eclipse-marketplace/downloads-monthly/{name}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $name): array
    {
        return [
            'downloads' => $this->client->get($name)->filterXPath('//installsrecent')->text(),
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
                name: 'monthly downloads',
                path: '/eclipse-marketplace/downloads-monthly/notepad4e',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
