<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Crates\Client;
use App\Badges\Templates\VersionTemplate;
use Illuminate\Routing\Route;

final class LatestVersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $version = $this->client->get($package)['max_version'];

        return VersionTemplate::make($this->service(), $version);
    }

    public function service(): string
    {
        return 'Crates';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/crates/version/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/crates/version/regex' => 'version',
        ];
    }
}
