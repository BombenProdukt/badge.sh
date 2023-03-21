<?php

declare(strict_types=1);

namespace App\Badges\BountySource\Badges;

use App\Badges\AbstractBadge;
use App\Badges\BountySource\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ActivityBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $team): array
    {
        return $this->renderNumber('activity', $this->client->get($team)['activity_total']);
    }

    public function service(): string
    {
        return 'BountySource';
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
