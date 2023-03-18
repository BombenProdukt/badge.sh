<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\NPM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        return [
            'label'       => $tag === 'latest' ? 'npm' : "npm@{$tag}",
            'status'      => $this->client->unpkg("{$package}@{$tag}/package.json")['version'],
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'npm';
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
            '/npm/v/{package}/{tag?}',
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
            '/npm/v/express'           => 'version',
            '/npm/v/yarn'              => 'version',
            '/npm/v/yarn/berry'        => 'version (tag)',
            '/npm/v/yarn/legacy'       => 'version (tag)',
            '/npm/v/@babel/core'       => 'version (scoped package)',
            '/npm/v/@nestjs/core/beta' => 'version (scoped & tag)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
