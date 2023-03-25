<?php

declare(strict_types=1);

namespace App\Badges\Dependabot\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/dependabot/status/{project}/{identifier?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'status',
                path: '/dependabot/status/thepracticaldev/dev.to',
                data: $this->render(['status' => 'success', 'statusColor' => 'green.600']),
            ),
            new BadgePreviewData(
                name: 'status',
                path: '/dependabot/status/dependabot/dependabot-core',
                data: $this->render(['status' => 'success', 'statusColor' => 'green.600']),
            ),
        ];
    }
}
