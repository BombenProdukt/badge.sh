<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: '',
                path: '/weblate/license/godot-engine/godot',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
