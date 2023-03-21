<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitLab\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class MergedMergeRequestsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, 'merge_requests?state=merged');

        return [
            'label'        => 'merged MRs',
            'message'      => FormatNumber::execute((int) $response->header('x-total')),
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'GitLab';
    }

    public function keywords(): array
    {
        return [Category::ISSUE_TRACKING];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/merged-merge-requests/{repo}',
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
            '/gitlab/merged-merge-requests/edouardklein/falsisign' => 'merged MRs',

        ];
    }
}
