<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class OpenIssuesBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/open-issues/{repo}',
    ];

    protected array $keywords = [
        Category::ISSUE_TRACKING,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->graphql($repo, 'openIssuesCount')['openIssuesCount'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'open issues',
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => $properties['count'] === 0 ? 'green.600' : 'orange.600',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'issues',
                path: '/gitlab/open-issues/gitlab-org/gitlab-runner',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
