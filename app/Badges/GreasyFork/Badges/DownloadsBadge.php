<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function handle(string $scriptId): array
    {
        return $this->renderDownloads($this->client->get($scriptId)['total_installs']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/greasyfork/downloads/{scriptId}',
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
            '/greasyfork/downloads/407466' => 'total downloads',
        ];
    }
}
