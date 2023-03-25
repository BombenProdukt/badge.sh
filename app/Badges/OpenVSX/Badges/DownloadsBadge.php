<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/downloads/{extension}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $extension): array
    {
        return [
            'downloads' => $this->client->get($extension)['downloadCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            '/open-vsx/downloads/idleberg/electron-builder' => 'downloads',
        ];
    }
}
