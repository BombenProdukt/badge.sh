<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/weblate/license/{project}/{component}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $project, string $component): array
    {
        return $this->client->component($project, $component);
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
            '/weblate/license/godot-engine/godot' => '',
        ];
    }
}
