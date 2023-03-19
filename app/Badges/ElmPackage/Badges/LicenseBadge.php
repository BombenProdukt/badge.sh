<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Badges\ElmPackage\Client;
use App\Badges\Templates\LicenseTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project): array
    {
        return LicenseTemplate::make($this->client->get($project)['license']);
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/elm-package/{project}/license',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/elm-package/mdgriffith/elm-ui/license' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
