<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Bitbucket\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class PipelinesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $repo, ?string $branch = null): array
    {
        $values = collect($this->client->pipelines($user, $repo, $branch))
            ->filter(fn (array $value) => $value['state']['name'] === 'COMPLETED');

        if (count($values) > 0) {
            return $this->renderStatus('build', $values[0]['state']['result']['name']);
        }

        return $this->renderStatus('build', 'never built');
    }

    public function service(): string
    {
        return 'Bitbucket';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/bitbucket/pipelines/{user}/{repo}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('branch', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bitbucket/pipelines/atlassian/adf-builder-javascript/task/SECO-2168' => 'build status',
        ];
    }
}
