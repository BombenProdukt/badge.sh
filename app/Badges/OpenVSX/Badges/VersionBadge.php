<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/version/{extension}',
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

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/open-vsx/version/idleberg/electron-builder',
                data: $this->render([]),
            ),
        ];
    }
}
