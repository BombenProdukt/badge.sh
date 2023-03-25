<?php

declare(strict_types=1);

namespace App\Badges\Bower\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/bower/license/{packageName}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'license' => $this->client->get($packageName)['normalized_licenses'],
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
                path: '/bower/license/bootstrap',
                data: $this->render([]),
            ),
        ];
    }
}
