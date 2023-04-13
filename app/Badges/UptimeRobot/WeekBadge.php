<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatPercentage;

final class WeekBadge extends AbstractBadge
{
    protected string $route = '/uptimerobot/week/{apiKey}';

    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $apiKey): array
    {
        return [
            'percentage' => \explode('-', $this->client->get($apiKey, 7)['custom_uptime_ratio'])[1],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'uptime /week',
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: '(past week) uptime',
                path: '/uptimerobot/week/m780862024-50db2c44c703e5c68d6b1ebb',
                data: $this->render(['percentage' => 99.9]),
            ),
            new BadgePreviewData(
                name: '(past week) uptime',
                path: '/uptimerobot/week/m780862024-50db2c44c703e5c68d6b1ebb',
                data: $this->render(['percentage' => 99]),
            ),
            new BadgePreviewData(
                name: '(past week) uptime',
                path: '/uptimerobot/week/m780862024-50db2c44c703e5c68d6b1ebb',
                data: $this->render(['percentage' => 97]),
            ),
            new BadgePreviewData(
                name: '(past week) uptime',
                path: '/uptimerobot/week/m780862024-50db2c44c703e5c68d6b1ebb',
                data: $this->render(['percentage' => 94]),
            ),
            new BadgePreviewData(
                name: '(past week) uptime',
                path: '/uptimerobot/week/m780862024-50db2c44c703e5c68d6b1ebb',
                data: $this->render(['percentage' => 80]),
            ),
        ];
    }
}
