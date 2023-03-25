<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;

final class DownloadsPerLinuxBadge extends AbstractBadge
{
    protected array $routes = [
        '/package-control/downloads-linux/{packageName}',
    ];

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
            '/package-control/downloads-linux/GitGutter' => 'linux downloads',
        ];
    }
}
