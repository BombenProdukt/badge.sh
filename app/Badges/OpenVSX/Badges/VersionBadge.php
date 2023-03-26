<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/version/{extension:wildcard}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $extension): array
    {
        return $this->client->get($extension);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/open-vsx/version/idleberg/electron-builder',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
