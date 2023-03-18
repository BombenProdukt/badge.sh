<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\OPAM\Client;
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

        return [
            'label'        => 'opam',
            'status'       => ExtractVersion::execute($matches[1]),
            'statusColor'  => ExtractVersionColor::execute($matches[1]),
        ];
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
            '/opam/v/{name}',
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
            '/opam/v/merlin'      => 'version',
            '/opam/v/ocamlformat' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
