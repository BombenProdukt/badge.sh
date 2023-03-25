<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/polymart/version/{resourceId}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $resourceId): array
    {
        return $this->client->get($resourceId)['updates']['latest'];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/polymart/version/323' => 'version',
        ];
    }
}
