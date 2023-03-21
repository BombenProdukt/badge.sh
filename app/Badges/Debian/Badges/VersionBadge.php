<?php

declare(strict_types=1);

namespace App\Badges\Debian\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Debian\Client;
use App\Badges\Templates\VersionTemplate;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName, ?string $distribution = 'stable'): array
    {
        return VersionTemplate::make($this->service(), array_key_first($this->client->version($packageName, $distribution)));
    }

    public function service(): string
    {
        return 'Debian';
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
            '/debian/version/{packageName}/{distribution?}',
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
            '/debian/version/apt'          => 'version',
            '/debian/version/apt/unstable' => 'version',
        ];
    }
}
