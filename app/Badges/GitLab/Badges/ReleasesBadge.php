<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class ReleasesBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, 'releases');

        return [
            'label'        => 'releases',
            'message'      => FormatNumber::execute((int) $response->header('x-total')),
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/releases/{repo}',
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
            '/gitlab/releases/AuroraOSS/AuroraStore' => 'release',
        ];
    }
}
