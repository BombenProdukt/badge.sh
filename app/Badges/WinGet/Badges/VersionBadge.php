<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/winget/version/{appId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $appId): array
    {
        return [
            'version' => $this->client->version($appId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/winget/version/GitHub.cli' => 'version',
            '/winget/version/Balena.Etcher' => 'version',
        ];
    }
}
