<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ReleasesBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/releases/{repo}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'releases')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('releases', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'release',
                path: '/gitlab/releases/AuroraOSS/AuroraStore',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
