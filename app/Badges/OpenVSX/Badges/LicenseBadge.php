<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/open-vsx/license/{extension}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $extension): array
    {
        return $this->client->get($extension);
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/open-vsx/license/idleberg/electron-builder',
                data: $this->render([]),
            ),
        ];
    }
}
