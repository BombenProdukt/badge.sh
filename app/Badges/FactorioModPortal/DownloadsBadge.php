<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/factorio-mod-portal/downloads/{modName}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $modName): array
    {
        return [
            'downloads' => $this->client->downloads($modName),
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
                path: '/factorio-mod-portal/downloads/rso-mod',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
