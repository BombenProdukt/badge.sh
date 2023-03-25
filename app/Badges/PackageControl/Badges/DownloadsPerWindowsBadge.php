<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;

final class DownloadsPerWindowsBadge extends AbstractBadge
{
    protected array $routes = [
        '/package-control/downloads-windows/{packageName}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'downloads' => $this->client->get($packageName)['installs']['windows'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerWindows($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/package-control/downloads-windows/GitGutter' => 'windows downloads',
        ];
    }
}
