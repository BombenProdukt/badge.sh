<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FactorioVersionBadge extends AbstractBadge
{
    protected string $route = '/factorio-mod-portal/factorio-version/{modName}';

    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

    public function handle(string $modName): array
    {
        return [
            'version' => $this->client->latestRelease($modName)['info_json']['factorio_version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'factorio version');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'factorio version',
                path: '/factorio-mod-portal/factorio-version/rso-mod',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
