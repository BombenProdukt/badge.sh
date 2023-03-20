<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Badges\UptimeRobot\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ResponseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $apiKey): array
    {
        return [
            'label'        => 'response',
            'message'      => $this->client->get($apiKey)['average_response_time'].'ms',
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'UptimeRobot';
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
            '/uptimerobot/{apiKey}/response',
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
            '/uptimerobot/m780862024-50db2c44c703e5c68d6b1ebb/response' => '(last hour) response',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
