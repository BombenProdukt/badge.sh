<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ContributorsBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/contributors/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'repository/contributors')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('contributors', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'contributors',
                path: '/gitlab/contributors/graphviz/graphviz',
                data: $this->render([]),
            ),
        ];
    }
}
