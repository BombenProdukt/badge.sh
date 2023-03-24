<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class OpenMergeRequestsBadge extends AbstractBadge
{
    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, 'merge_requests?state=opened');

        return [
            'label'        => 'open MRs',
            'message'      => FormatNumber::execute((int) $response->header('x-total')),
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/open-merge-requests/{repo}',
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
            '/gitlab/open-merge-requests/edouardklein/falsisign' => 'open MRs',

        ];
    }
}
