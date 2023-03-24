<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class ContributorsBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, 'repository/contributors');

        return [
            'label'        => 'contributors',
            'message'      => FormatNumber::execute((int) $response->header('x-total')),
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/contributors/{repo}',
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
            '/gitlab/contributors/graphviz/graphviz' => 'contributors',
        ];
    }
}
