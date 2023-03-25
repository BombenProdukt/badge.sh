<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NameBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagist/name/{package}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return $this->client->get($package);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'packagist',
            'message' => $properties['name'],
            'messageColor' => 'green.600',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'name',
                path: '/packagist/name/monolog/monolog',
                data: $this->render([]),
            ),
        ];
    }
}
