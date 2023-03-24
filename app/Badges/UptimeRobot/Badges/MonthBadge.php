<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatPercentage;

final class MonthBadge extends AbstractBadge
{
    public function handle(string $apiKey): array
    {
        return [
            'percentage' => explode('-', $this->client->get($apiKey, 30)['custom_uptime_ratio'])[2],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'uptime /month',
            'message'      => FormatPercentage::execute($properties['percentage']),
            'messageColor' => match (true) {
                $properties['percentage'] >= 99.9 => '9C1',
                $properties['percentage'] >= 99   => 'EA2',
                $properties['percentage'] >= 97   => 'orange.600',
                $properties['percentage'] >= 94   => 'red.600',
                default                           => 'green.600',
            },
        ];
    }

    public function keywords(): array
    {
        return [Category::MONITORING];
    }

    public function routePaths(): array
    {
        return [
            '/uptimerobot/month/{apiKey}',
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
            '/uptimerobot/month/m780862024-50db2c44c703e5c68d6b1ebb' => '(past month) uptime',
        ];
    }
}
