<?php

declare(strict_types=1);

namespace App\Badges\BountySource\Badges;

use App\Badges\BountySource\Client;
use App\Badges\Templates\NumberTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ActivityBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $team): array
    {
        return NumberTemplate::make('activity', $this->client->get($team)['activity_total']);
    }

    public function service(): string
    {
        return 'BountySource';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/bountysource/{team}/activity',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bountysource/mozilla-core/activity' => 'activity',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
