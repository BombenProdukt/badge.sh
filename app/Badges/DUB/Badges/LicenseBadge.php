<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Badges\DUB\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $license = $this->client->get("{$package}/latest/info")['info']['license'];

        return [
            'label'       => 'license',
            'status'      => $license,
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'DUB';
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
            '/dub/license/{package}',
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
            '/dub/license/arsd-official' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
