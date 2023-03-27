<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ResponseBadge extends AbstractBadge
{
    protected string $route = '/uptimerobot/response/{apiKey}';

    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $apiKey): array
    {
        return [
            'time' => $this->client->get($apiKey)['average_response_time'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'response',
            'message' => $properties['time'].'ms',
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: '(last hour) response',
                path: '/uptimerobot/response/m780862024-50db2c44c703e5c68d6b1ebb',
                data: $this->render(['time' => 0]),
            ),
        ];
    }
}
