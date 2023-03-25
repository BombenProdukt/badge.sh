<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ClosedMergeRequestsBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/closed-merge-requests/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'merge_requests?state=closed')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('closed MRs', $properties['count']);
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
            '/gitlab/closed-merge-requests/edouardklein/falsisign' => 'closed MRs',
        ];
    }
}
