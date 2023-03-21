<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Badges\AbstractBadge;
use App\Badges\ElmPackage\Client;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        return $this->renderLicense($this->client->get($project)['license']);
    }

    public function service(): string
    {
        return 'Elm Package';
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
            '/elm-package/license/{project}',
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
            '/elm-package/license/mdgriffith/elm-ui' => 'license',
        ];
    }
}
