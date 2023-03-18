<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\ElmPackage\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $name): array
    {
        $version = $this->client->get($owner, $name)['version'];

        return [
            'label'        => 'elm package',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
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
            '/elm-package/v/{owner}/{name}',
            '/elm-package/version/{owner}/{name}',
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
            '/elm-package/v/avh4/elm-color'       => 'version',
            '/elm-package/version/avh4/elm-color' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
