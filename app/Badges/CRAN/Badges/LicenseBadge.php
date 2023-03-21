<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CRAN\Client;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->db($package);

        return $this->renderLicense(preg_replace('/\s*\S\s+file\s+LICEN[CS]E$/i', '', $response['License']));
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
            '/cran/license/{package}',
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
            '/cran/license/ggplot2' => 'license',
        ];
    }
}
