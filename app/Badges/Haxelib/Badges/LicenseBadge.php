<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/haxelib/license/{project}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $project): array
    {
        return [
            'license' => $this->client->get($project),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/haxelib/license/openfl' => 'license',
        ];
    }
}
