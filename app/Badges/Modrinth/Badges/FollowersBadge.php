<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FollowersBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        return [
            'count' => $this->client->project($projectId)['followers'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('followers', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/modrinth/followers/{projectId}',
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
            '/modrinth/followers/AANobbMI' => 'followers',
        ];
    }
}
