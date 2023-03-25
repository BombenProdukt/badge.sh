<?php

declare(strict_types=1);

namespace App\Badges\HexPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerWeekBadge extends AbstractBadge
{
    protected array $routes = [
        '/hex/downloads-weekly/{packageName}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['downloads']['week'],
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
                name: 'total downloads',
                path: '/hex/downloads-weekly/plug',
                data: $this->render([]),
            ),
        ];
    }
}
