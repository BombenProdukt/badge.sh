<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function handle(string $modName): array
    {
        return $this->renderDownloads($this->client->downloads($modName));
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/factorio-mod-portal/downloads/{modName}',
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
            '/factorio-mod-portal/downloads/rso-mod' => 'downloads',
        ];
    }
}
