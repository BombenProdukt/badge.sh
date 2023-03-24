<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FactorioVersionBadge extends AbstractBadge
{
    public function handle(string $modName): array
    {
        return [
            'version' => $this->client->latestRelease($modName)['info_json']['factorio_version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version'], 'factorio version');
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT, Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/factorio-mod-portal/factorio-version/{modName}',
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
            '/factorio-mod-portal/factorio-version/rso-mod' => 'factorio version',
        ];
    }
}
