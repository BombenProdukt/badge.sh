<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LastCommitBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/last-commit/{repo}/{ref?}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $repo, ?string $ref = null): array
    {
        return [
            'date' => $this->client->rest($repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->json('0.committed_date'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last commit', $properties['date']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'last commit',
                path: '/gitlab/last-commit/gitlab-org/gitlab-development-kit',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'last commit (branch ref)',
                path: '/gitlab/last-commit/gitlab-org/gitlab-development-kit/updating-chromedriver-install-v2',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'last commit (tag ref)',
                path: '/gitlab/last-commit/gitlab-org/gitlab-development-kit/v0.2.5',
                data: $this->render([]),
            ),
        ];
    }
}
