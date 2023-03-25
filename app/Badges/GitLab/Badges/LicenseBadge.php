<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/license/{repo}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $repo): array
    {
        return [
            'license' => $this->client->rest($repo, '?license=true')->json('license.name'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/gitlab/license/gitlab-org/omnibus-gitlab',
                data: $this->render([]),
            ),
        ];
    }
}
