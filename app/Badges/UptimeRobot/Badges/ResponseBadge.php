<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ResponseBadge extends AbstractBadge
{
    public function handle(string $apiKey): array
    {
        return [
            'time' => $this->client->get($apiKey)['average_response_time'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'response',
            'message'      => $properties['time'].'ms',
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::MONITORING];
    }

    public function routePaths(): array
    {
        return [
            '/uptimerobot/response/{apiKey}',
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
            '/uptimerobot/response/m780862024-50db2c44c703e5c68d6b1ebb' => '(last hour) response',
        ];
    }
}
