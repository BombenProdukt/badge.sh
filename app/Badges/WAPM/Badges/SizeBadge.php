<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class SizeBadge extends AbstractBadge
{
    protected array $routes = [
        '/wapm/size/{package}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $package): array
    {
        return $this->client->get($package)['distribution'];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['size']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'size',
                path: '/wapm/size/coreutils',
                data: $this->render(['size' => '1024']),
            ),
        ];
    }
}
