<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/eclipse-marketplace/license/{name}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $name): array
    {
        return [
            'license' => $this->client->get($name)->filterXPath('//license')->text(),
        ];
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
                path: '/eclipse-marketplace/license/notepad4e',
                data: $this->render([]),
            ),
        ];
    }
}
