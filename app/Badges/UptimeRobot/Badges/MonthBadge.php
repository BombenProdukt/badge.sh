<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Actions\FormatPercentage;
use App\Badges\UptimeRobot\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MonthBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $apiKey): array
    {
        $response = $this->client->get($apiKey);

        [,,$percentage] = explode('-', $response['custom_uptime_ratio']);

        return [
            'label'       => 'uptime /month',
            'status'      => FormatPercentage::execute($percentage),
            'statusColor' => match (true) {
                $percentage >= 99.9 => '9C1',
                $percentage >= 99   => 'EA2',
                $percentage >= 97   => 'orange.600',
                $percentage >= 94   => 'red.600',
                default             => 'green.600',
            },
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
            '/uptime-robot/month/{apiKey}',
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
            '/uptime-robot/month/m780862024-50db2c44c703e5c68d6b1ebb' => '(past month) uptime',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
