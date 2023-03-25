<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/haxelib/version/{project}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project): array
    {
        return [
            'version' => $this->client->get($project),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            '/haxelib/version/tink_http' => 'version',
            '/haxelib/version/nme' => 'version',
        ];
    }
}
