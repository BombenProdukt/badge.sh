<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/homebrew/version/{type:cask,formula}/{package}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $type, string $package): array
    {
        $response = $this->client->get($type, $package);

        return [
            'version' => $response['version'] ?? $response['versions']['stable'],
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
                path: '/homebrew/version/formula/fish',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/homebrew/version/cask/1password',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
