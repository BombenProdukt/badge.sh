<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Badges\OPAM\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        preg_match('/class="package-version">([^<]+)<\//i', $this->client->get($name), $matches);

        return VersionTemplate::make($this->service(), $matches[1]);
    }

    public function service(): string
    {
        return 'OPAM';
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
            '/opam/{name}/version',
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
            '/opam/merlin/version'      => 'version',
            '/opam/ocamlformat/version' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}