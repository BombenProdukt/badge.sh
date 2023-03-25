<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/factorio-mod-portal/version/{modName}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $modName): array
    {
        return $this->client->latestRelease($modName);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'mod portal version',
                path: '/factorio-mod-portal/version/rso-mod',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
