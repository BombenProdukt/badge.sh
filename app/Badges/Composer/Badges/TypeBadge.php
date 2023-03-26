<?php

declare(strict_types=1);

namespace App\Badges\Composer\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TypeBadge extends AbstractBadge
{
    protected array $routes = [
        '/composer/type/{service}/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $service, string $user, string $repo): array
    {
        $response = $this->client->github($user, $repo);

        return [
            'name' => $response['name'],
            'type' => $response['type'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('type', $properties['type']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'type',
                path: '/composer/type/github/laravel/laravel',
                data: $this->render(['type' => 'project']),
            ),
        ];
    }
}
