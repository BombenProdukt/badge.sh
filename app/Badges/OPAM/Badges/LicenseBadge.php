<?php

declare(strict_types=1);

namespace App\Badges\OPAM\Badges;

use App\Badges\OPAM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        preg_match('/<th>license<\/th>\s*<td>([^<]+)<\//i', $this->client->get($name), $matches);

        return [
            'label'       => 'license',
            'status'      => $matches[1] ?? 'unknown',
            'statusColor' => 'blue.600',
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
            '/opam/license/{name}',
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
            '/opam/license/cohttp' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
