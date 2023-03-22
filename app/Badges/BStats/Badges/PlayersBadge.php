<?php

declare(strict_types=1);

namespace App\Badges\BStats\Badges;

use App\Badges\AbstractBadge;
use App\Badges\BStats\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class PlayersBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId): array
    {
        return $this->renderNumber('players', $this->client->players($projectId));
    }

    public function service(): string
    {
        return 'bStats';
    }

    public function keywords(): array
    {
        return [Category::METRICS];
    }

    public function routePaths(): array
    {
        return [
            '/bstats/players/{projectId}',
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
            '/bstats/players/74299' => 'players',
        ];
    }
}
