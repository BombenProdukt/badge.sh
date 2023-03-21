<?php

declare(strict_types=1);

namespace App\Badges\FactorioModPortal\Badges;

use App\Badges\AbstractBadge;
use App\Badges\FactorioModPortal\Client;
use Illuminate\Routing\Route;

final class FactorioVersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $modName): array
    {
        return $this->renderVersion('factorio version', $this->client->latestRelease($modName)['info_json']['factorio_version']);
    }

    public function service(): string
    {
        return 'Factorio Mod Portal';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
