<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class EntitiesBadge extends AbstractBadge
{
    protected array $routes = [
        '/weblate/entities/{type}',
    ];

    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $type): array
    {
        return [
            'type' => $type,
            'count' => $this->client->entity($type)['count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['type'], $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('type', ['components', 'projects', 'users', 'languages']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/weblate/entities/components' => 'components',
            '/weblate/entities/languages' => 'languages',
            '/weblate/entities/projects' => 'projects',
            '/weblate/entities/users' => 'users',
        ];
    }
}
