<?php

declare(strict_types=1);

namespace App\Badges\HexPM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/hex/downloads/{packageName}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['downloads']['all'],
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
                path: '/hex/downloads/plug',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
