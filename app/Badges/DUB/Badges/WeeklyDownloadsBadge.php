<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class WeeklyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $downloads = $this->client->get("{$package}/stats")['downloads'];

        return $this->renderDownloadsPerWeek($downloads['weekly']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/dub/downloads-weekly/{package}',
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
            '/dub/downloads-weekly/vibe-d' => 'weekly downloads',
        ];
    }
}
