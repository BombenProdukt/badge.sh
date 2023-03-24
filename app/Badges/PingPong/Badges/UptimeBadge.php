<?php

declare(strict_types=1);

namespace App\Badges\PingPong\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UptimeBadge extends AbstractBadge
{
    public function handle(string $apiKey): array
    {
        return [
            'percentage' => $this->client->uptime($apiKey),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('uptime', $properties['percentage']);
    }

    public function keywords(): array
    {
        return [Category::MONITORING];
    }

    public function routePaths(): array
    {
        return [
            '/pingpong/uptime/{apiKey}',
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
            '/pingpong/uptime/sp_2e80bc00b6054faeb2b87e2464be337e' => 'uptime',
        ];
    }
}
