<?php

declare(strict_types=1);

namespace App\Badges\Dependabot\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/dependabot/status/{project}/{identifier?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    /**
     * The deprecation dates and reasons.
     *
     * @var array<string, string>
     */
    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

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
}
