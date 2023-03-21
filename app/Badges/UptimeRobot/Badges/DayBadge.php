<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Badges\AbstractBadge;
use App\Badges\UptimeRobot\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatPercentage;

final class DayBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $apiKey): array
    {
        $response = $this->client->get($apiKey, 1);

        [$percentage] = explode('-', $response['custom_uptime_ratio']);

        return [
            'label'        => 'uptime /24h',
            'message'      => FormatPercentage::execute($percentage),
            'messageColor' => match (true) {
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

    public function keywords(): array
    {
        return [Category::MONITORING];
    }

    public function routePaths(): array
    {
        return [
            '/uptimerobot/day/{apiKey}',
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
            '/uptimerobot/day/m780862024-50db2c44c703e5c68d6b1ebb' => '(24 hours) uptime',
        ];
    }
}
