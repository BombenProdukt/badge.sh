<?php

declare(strict_types=1);

namespace App\Badges\Dependabot\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $project, ?string $identifier = null): array
    {
        $response = $this->client->get($project, $identifier);

        return [
            'status' => $response['status'],
            'statusColor' => $response['colour'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'Dependabot',
            'message' => $properties['status'],
            'messageColor' => $properties['statusColor'],
        ];
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/dependabot/status/{project}/{identifier?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/dependabot/status/thepracticaldev/dev.to' => 'status',
            '/dependabot/status/dependabot/dependabot-core' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
