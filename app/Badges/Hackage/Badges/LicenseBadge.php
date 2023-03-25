<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/hackage/license/{package}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package): array
    {
        return $this->client->hackage($package);
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/hackage/license/Cabal',
                data: $this->render([]),
            ),
        ];
    }
}
