<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MergeRequestsBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'merge_requests')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('MRs', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/merge-requests/{repo}',
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
            '/gitlab/merge-requests/edouardklein/falsisign' => 'MRs',
        ];
    }
}
