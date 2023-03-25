<?php

declare(strict_types=1);

namespace App\Badges\ArchLinux\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/arch-linux/version/{repository}/{architecture}/{package}',
    ];

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
            '/arch-linux/version/core/x86_64/pacman' => 'version',
        ];
    }
}
