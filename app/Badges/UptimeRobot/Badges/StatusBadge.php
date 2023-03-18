<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Badges\UptimeRobot\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    private array $statuses = [
        '0' => ['paused', 'yellow.600'],
        '1' => ['not checked yet', 'gray.600'],
        '2' => ['up', 'green.600'],
        '8' => ['seems down', 'orange.600'],
        '9' => ['down', 'red.600'],
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $apiKey): array
    {
        $response = $this->client->get($apiKey);

        return [
            'label'       => 'status',
            'status'      => $this->statuses[$response['status']][0],
            'statusColor' => $this->statuses[$response['status']][1],
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
            '/uptime-robot/status/{apiKey}',
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
            '/uptime-robot/status/m780862024-50db2c44c703e5c68d6b1ebb' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
