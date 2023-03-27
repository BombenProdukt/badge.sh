<?php

declare(strict_types=1);

namespace App\Badges\AppleMusic\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/apple-music/version/{bundleId}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $bundleId): array
    {
        return [
            'version' => $this->client->version($bundleId),
        ];
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
                path: '/apple-music/version/803453959',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
