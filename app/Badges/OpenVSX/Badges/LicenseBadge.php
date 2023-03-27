<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected string $route = '/open-vsx/license/{extension:wildcard}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $extension): array
    {
        return $this->client->get($extension);
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
                path: '/open-vsx/license/idleberg/electron-builder',
                data: $this->render(['license' => 'MIT']),
            ),
        ];
    }
}
