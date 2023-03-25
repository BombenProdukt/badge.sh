<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionForFormulaBadge extends AbstractBadge
{
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

    public function routePaths(): array
    {
        return [
            '/homebrew/version/{package}',
            '/homebrew/version/{package}/formula',
            '/homebrew/version/{package}/cask',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('type', ['cask', 'formula']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/homebrew/version/fish',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/homebrew/version/cake',
                data: $this->render([]),
            ),
        ];
    }
}
