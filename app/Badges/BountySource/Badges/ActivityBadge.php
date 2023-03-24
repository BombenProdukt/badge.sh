<?php

declare(strict_types=1);

namespace App\Badges\BountySource\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ActivityBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/bountysource/activity/{team}',
        ];
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
