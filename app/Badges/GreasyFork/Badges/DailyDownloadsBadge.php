<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DailyDownloadsBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/greasyfork/downloads-daily/{package}',
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
            '/greasyfork/downloads-daily/407466' => 'daily downloads',
        ];
    }
}
