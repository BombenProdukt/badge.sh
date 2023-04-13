<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/snapcraft/license/{snap}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $snap): array
    {
        return $this->client->get($snap)['snap'];
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
                path: '/snapcraft/license/okular',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
