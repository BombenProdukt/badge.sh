<?php

declare(strict_types=1);

namespace App\Badges\VPM\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/vpm/version/{packageId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageId): array
    {
        return [
            'version' => \array_key_last($this->client->versions($packageId)),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/vpm/version/com.vrchat.udonsharp' => 'version',
        ];
    }
}
