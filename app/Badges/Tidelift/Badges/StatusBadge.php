<?php

declare(strict_types=1);

namespace App\Badges\Tidelift\Badges;

use App\Badges\Tidelift\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $platform, string $name): array
    {
        $location = $this->client->get($platform, $name);

        if (empty($location)) {
            return [
                'label'       => 'tidelift',
                'status'      => 'not found',
                'statusColor' => 'red.600',
            ];
        }

        [, $status, $statusColor] = explode('-', parse_url(urldecode($location))['path']);

        return [
            'label'       => 'tidelift',
            'status'      => str_replace('!', '', $status),
            'statusColor' => str_replace('.svg', '', $statusColor),
        ];
    }

    public function service(): string
    {
        return 'Tidelift';
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
            '/tidelift/{platform}/{name}/status',
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
            '/tidelift/npm/minimist/status' => 'subscription',
            '/tidelift/npm/got/status'      => 'subscription',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
