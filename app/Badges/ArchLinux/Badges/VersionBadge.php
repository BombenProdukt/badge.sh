<?php

declare(strict_types=1);

namespace App\Badges\ArchLinux\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/arch-linux/version/{repository}/{architecture}/{package}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $repository, string $architecture, string $package): array
    {
        return [
            'version' => $this->client->get($repository, $architecture, $package)['pkgver'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/arch-linux/version/core/x86_64/pacman',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
