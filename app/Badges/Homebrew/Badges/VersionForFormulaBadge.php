<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionForFormulaBadge extends AbstractBadge
{
    protected array $routes = [
        '/homebrew/version/{package}',
        '/homebrew/version/formula/{package}',
        '/homebrew/version/cask/{package}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $package): array
    {
        $response = $this->client->get('formula', $package);

        if (isset($response['version'])) {
            return [
                'version' => $response['version'],
            ];
        }

        return [
            'version' => $response['versions']['stable'],
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
                path: '/homebrew/version/fish',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/homebrew/version/cake',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
