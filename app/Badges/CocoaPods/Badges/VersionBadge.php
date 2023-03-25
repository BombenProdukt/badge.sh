<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/cocoapods/version/{pod}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $pod): array
    {
        return $this->client->get($pod);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/cocoapods/version/AFNetworking' => 'version',
        ];
    }
}
