<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionForFormulaBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/homebrew/version/{package}',
            '/homebrew/version/{package}/formula',
            '/homebrew/version/{package}/cask',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('type', ['cask', 'formula']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/homebrew/version/fish' => 'version',
            '/homebrew/version/cake' => 'version',
        ];
    }
}
