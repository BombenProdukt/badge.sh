<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\NPM\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        return VersionTemplate::make(
            $tag === 'latest' ? 'npm' : "npm@{$tag}",
            $this->client->unpkg("{$package}@{$tag}/package.json")['version'],
        );
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
            '/npm/version/{package}/{tag?}',
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
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
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
            '/npm/version/express'           => 'version',
            '/npm/version/yarn'              => 'version',
            '/npm/version/yarn/berry'        => 'version (tag)',
            '/npm/version/yarn/legacy'       => 'version (tag)',
            '/npm/version/@babel/core'       => 'version (scoped package)',
            '/npm/version/@nestjs/core/beta' => 'version (scoped & tag)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
