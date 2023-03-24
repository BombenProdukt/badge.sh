<?php

declare(strict_types=1);

namespace App\Badges\CodeClimate\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class IssuesBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        return [
            'count' => $this->client->get($project, 'snapshots')['meta']['issues_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('issues', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/codeclimate/issues/{project}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/codeclimate/issues/codeclimate/codeclimate' => 'issues',
        ];
    }
}
