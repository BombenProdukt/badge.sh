<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\Templates\VersionTemplate;
use App\Badges\VisualStudioMarketplace\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        $version = $this->client->get($extension)['versions'][0]['version'];

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'Visual Studio Marketplace';
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
            '/vs-marketplace/version/{extension}',
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
            '/vs-marketplace/version/vscodevim.vim' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
