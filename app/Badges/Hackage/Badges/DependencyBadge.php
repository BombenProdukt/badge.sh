<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Badges\Hackage\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class DependencyBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $client = Http::baseUrl('https://packdeps.haskellers.com/')->throw();
        $client->get("licenses/{$package}");

        $outdated = str_contains($client->get("feed/{$package}")->body(), "Outdated dependencies for {$package}");

        return TextTemplate::make('dependencies', $outdated ? 'outdated' : 'up-to-date', $outdated ? 'red.600' : 'green.600');
    }

    public function service(): string
    {
        return 'Hackage';
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
            '/hackage/dependencies/{package}',
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
            '/hackage/dependencies/Cabal' => 'dependencies',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
