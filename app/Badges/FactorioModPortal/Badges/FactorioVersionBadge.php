<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FactorioVersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/factorio-mod-portal/factorio-version/{modName}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::PLATFORM_SUPPORT, Category::VERSION,
    ];

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
