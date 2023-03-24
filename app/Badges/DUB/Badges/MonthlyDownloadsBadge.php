<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $downloads = $this->client->get("{$package}/stats")['downloads'];

        return $this->renderDownloadsPerMonth($downloads['monthly']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/dub/downloads-monthly/{package}',
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
            '/dub/downloads-monthly/vibe-d' => 'monthly downloads',
        ];
    }
}
