<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class MergeRequestsBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/merge-requests/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'MRs',
                path: '/gitlab/merge-requests/edouardklein/falsisign',
                data: $this->render([]),
            ),
        ];
    }
}
