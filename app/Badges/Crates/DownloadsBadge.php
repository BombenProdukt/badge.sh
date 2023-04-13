<?php

declare(strict_types=1);

namespace App\Badges\Crates;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/crates/downloads/{package}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package);
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
                path: '/crates/downloads/regex',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
