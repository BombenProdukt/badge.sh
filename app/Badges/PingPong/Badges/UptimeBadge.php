<?php

declare(strict_types=1);

namespace App\Badges\PingPong\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UptimeBadge extends AbstractBadge
{
    protected string $route = '/pingpong/uptime/{apiKey}';

    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $apiKey): array
    {
        return [
            'percentage' => $this->client->uptime($apiKey),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('uptime', $properties['percentage']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'uptime',
                path: '/pingpong/uptime/sp_2e80bc00b6054faeb2b87e2464be337e',
                data: $this->render(['percentage' => '100']),
            ),
        ];
    }
}
