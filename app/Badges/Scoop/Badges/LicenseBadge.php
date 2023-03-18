<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Badges\Scoop\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $app): array
    {
        $response = $this->client->main($app);

        return [
            'label'        => 'scoop',
            'status'       => $response['license'],
            'statusColor'  => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Scoop';
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
            '/scoop/license/{app}',
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
            '/scoop/license/caddy' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
