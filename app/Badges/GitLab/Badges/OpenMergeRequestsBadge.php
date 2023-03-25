<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class OpenMergeRequestsBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/open-merge-requests/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'merge_requests?state=opened')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('open MRs', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'open MRs',
                path: '/gitlab/open-merge-requests/edouardklein/falsisign',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
