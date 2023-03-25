<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/uptimerobot/status/{apiKey}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::CODE_FORMATTING,
    ];
    private array $statuses = [
        '0' => ['paused', 'yellow.600'],
        '1' => ['not checked yet', 'gray.600'],
        '2' => ['up', 'green.600'],
        '8' => ['seems down', 'orange.600'],
        '9' => ['down', 'red.600'],
    ];

    public function handle(string $apiKey): array
    {
        return $this->client->get($apiKey);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'status',
            'message' => $this->statuses[$properties['status']][0],
            'messageColor' => $this->statuses[$properties['status']][1],
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
            '/uptimerobot/status/m780862024-50db2c44c703e5c68d6b1ebb' => 'status',
        ];
    }
}
