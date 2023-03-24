<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $modName): array
    {
        return $this->renderVersion($this->client->latestRelease($modName)['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/factorio-mod-portal/version/{modName}',
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
            '/factorio-mod-portal/version/rso-mod' => 'mod portal version',
        ];
    }
}
