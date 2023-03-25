<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class InstallBadge extends AbstractBadge
{
    protected array $routes = [
        '/packagephobia/size/{name}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'size' => $response['install']['pretty'],
            'color' => $response['install']['color'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'install size',
            'message' => $properties['size'],
            'messageColor' => \str_replace('#', '', $properties['color']),
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'install size',
                path: '/packagephobia/size/webpack',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'install size',
                path: '/packagephobia/size/@tusbar/cache-control',
                data: $this->render([]),
            ),
        ];
    }
}
