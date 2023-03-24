<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class EntitiesBadge extends AbstractBadge
{
    public function handle(string $type): array
    {
        return $this->renderNumber($type, $this->client->entity($type)['count']);
    }

    public function keywords(): array
    {
        return [Category::METRICS];
    }

    public function routePaths(): array
    {
        return [
            '/weblate/entities/{type}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
            '/weblate/entities/languages'  => 'languages',
            '/weblate/entities/projects'   => 'projects',
            '/weblate/entities/users'      => 'users',
        ];
    }
}
