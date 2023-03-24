<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ReleaseBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, 'releases')->json(0);

        if (empty($response)) {
            return [
                'label'        => 'release',
                'message'      => 'none',
                'messageColor' => 'yellow.600',
            ];
        }

        return [
            'label'        => 'release',
            'message'      => $response['name'],
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/latest-release/{repo}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/gitlab/latest-release/veloren/veloren' => 'latest release',
        ];
    }
}
