<?php

declare(strict_types=1);

namespace App\Badges\PingPong\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PingPong\Client;
use Illuminate\Routing\Route;

final class UptimeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $apiKey): array
    {
        return $this->renderPercentage('uptime', $this->client->uptime($apiKey));
    }

    public function service(): string
    {
        return 'PingPong';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
