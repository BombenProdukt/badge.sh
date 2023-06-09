<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DownloadsPerDayBadge extends AbstractBadge
{
    protected string $route = '/greasyfork/downloads-daily/{package}';

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $scriptId): array
    {
        return [
            'downloads' => $this->client->get($scriptId)['daily_installs'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloadsPerDay($properties['downloads']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'daily downloads',
                path: '/greasyfork/downloads-daily/407466',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
