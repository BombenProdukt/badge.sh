<?php

declare(strict_types=1);

namespace App\Badges\WAPM;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/wapm/version/{package:wildcard}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package);
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
                path: '/wapm/version/zamfofex/greg',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/wapm/version/cowsay',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
