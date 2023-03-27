<?php

declare(strict_types=1);

namespace App\Badges\Debian\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/debian/version/{packageName}/{distribution?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $packageName, ?string $distribution = 'stable'): array
    {
        return [
            'version' => \array_key_first($this->client->version($packageName, $distribution)),
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
                path: '/debian/version/apt',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/debian/version/apt/unstable',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
