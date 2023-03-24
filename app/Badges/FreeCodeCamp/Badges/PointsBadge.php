<?php

declare(strict_types=1);

namespace App\Badges\FreeCodeCamp\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PointsBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        return $this->client->get($username)['entities']['user'][$username];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('freecodecamp', $properties['points']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/freecodecamp/points/{username}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/freecodecamp/points/sethi' => 'points',
        ];
    }
}
