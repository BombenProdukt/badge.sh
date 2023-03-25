<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ForksBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/forks/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->graphql($repo, 'forksCount')['forksCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('forks', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'forks',
                path: '/gitlab/forks/inkscape/inkscape',
                data: $this->render([]),
            ),
        ];
    }
}
