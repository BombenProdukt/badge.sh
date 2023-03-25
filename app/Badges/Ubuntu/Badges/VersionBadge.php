<?php

declare(strict_types=1);

namespace App\Badges\Ubuntu\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/ubuntu/version/{packageName}/{series?}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName, ?string $series = null): array
    {
        return [
            'version' => $this->client->version($packageName, $series),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/ubuntu/version/ubuntu-wallpapers' => 'version',
            '/ubuntu/version/ubuntu-wallpapers/bionic' => 'version',
        ];
    }
}
