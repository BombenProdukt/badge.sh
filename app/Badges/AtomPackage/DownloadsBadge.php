<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/apm/downloads/{package}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
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
                path: '/apm/downloads/linter',
                data: $this->render(['downloads' => '1000000']),
                deprecated: true,
            ),
        ];
    }
}
