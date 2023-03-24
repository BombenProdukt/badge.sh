<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    public function handle(string $modName): array
    {
        return $this->renderDate('last modified', $this->client->latestRelease($modName)['released_at']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/factorio-mod-portal/last-modified/{modName}',
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
            '/factorio-mod-portal/last-modified/rso-mod' => 'factorio version',
        ];
    }
}
