<?php

declare(strict_types=1);

namespace App\Badges\PackageControl;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerLinuxBadge extends AbstractBadge
{
    protected string $route = '/package-control/downloads-linux/{packageName}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['installs']['linux'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerLinux($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'linux downloads',
                path: '/package-control/downloads-linux/GitGutter',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
