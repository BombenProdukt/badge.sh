<?php

declare(strict_types=1);

namespace App\Badges\BountySource\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ActivityBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/bountysource/activity/{team}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $team): array
    {
        return [
            'count' => $this->client->get($team)['activity_total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('activity', $properties['count']);
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bountysource/activity/mozilla-core' => 'activity',
        ];
    }
}
