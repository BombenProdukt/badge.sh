<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CRAN\Client;
use Illuminate\Routing\Route;

final class RVersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $version = preg_replace('/([<>=]+)\s+/', '$1', $this->client->db($package)['Depends']['R']);

        return $this->renderVersion('R', $version);
    }

    public function service(): string
    {
        return 'CRAN';
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
            '/cran/r-version/{package}',
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
            '/cran/r-version/data.table' => 'r version',
        ];
    }
}
