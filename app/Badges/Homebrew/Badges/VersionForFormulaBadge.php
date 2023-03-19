<?php

declare(strict_types=1);

namespace App\Badges\Homebrew\Badges;

use App\Badges\Homebrew\Client;
use App\Badges\Templates\VersionTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionForFormulaBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->get('formula', $package);

        if (isset($response['version'])) {
            $version = $response['version'];
        } else {
            $version = $response['versions']['stable'];
        }

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'Homebrew';
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
            '/homebrew/{package}/version',
            '/homebrew/{package}/formula/version',
            '/homebrew/{package}/cask/version',
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
        $route->whereIn('type', ['cask', 'formula']);
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
            '/homebrew/fish/version' => 'version',
            '/homebrew/cake/version' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
