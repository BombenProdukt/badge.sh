<?php

declare(strict_types=1);

namespace App\Badges\NPM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/npm/license/{package:packageWithScope}/{tag?}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        return $this->client->unpkg("{$package}@{$tag}/package.json");
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
                path: '/npm/license/lodash',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
