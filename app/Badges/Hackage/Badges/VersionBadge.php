<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/hackage/version/{package}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return $this->client->hackage($package);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/hackage/version/abt' => 'version',
            '/hackage/version/Cabal' => 'version',
        ];
    }
}
