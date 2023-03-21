<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Badges\AbstractBadge;
use App\Badges\FactorioModPortal\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $modName): array
    {
        return $this->renderVersion($this->client->latestRelease($modName)['version']);
    }

    public function service(): string
    {
        return 'Factorio Mod Portal';
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
