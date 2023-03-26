<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TotalDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/npm/downloads/{package:wildcard}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'downloads' => collect($this->client->api('downloads/range/2005-01-01:'.\date('Y')."-01-01/{$package}")['downloads'])->sum('downloads'),
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
                path: '/npm/downloads/express',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
