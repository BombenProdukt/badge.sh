<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatPercentage;

final class DayBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/uptimerobot/day/{apiKey}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $apiKey): array
    {
        return [
            'percentage' => \explode('-', $this->client->get($apiKey, 1)['custom_uptime_ratio'])[0],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'uptime /24h',
            'message' => FormatPercentage::execute($properties['percentage']),
            'messageColor' => match (true) {
                $properties['percentage'] >= 99.9 => '9C1',
                $properties['percentage'] >= 99 => 'EA2',
                $properties['percentage'] >= 97 => 'orange.600',
                $properties['percentage'] >= 94 => 'red.600',
                default => 'green.600',
            },
        ];
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
