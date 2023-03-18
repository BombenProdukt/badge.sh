<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Badges\ElmPackage\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $name): array
    {
        $license = $this->client->get($owner, $name)['license'];

        return [
            'label'        => 'license',
            'status'       => $license,
            'statusColor'  => 'blue.600',
        ];
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
            '/elm-package/license/{owner}/{name}',
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
            '/elm-package/license/mdgriffith/elm-ui' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
