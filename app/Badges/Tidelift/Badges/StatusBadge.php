<?php

declare(strict_types=1);

namespace App\Badges\Tidelift\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Tidelift\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
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
                'label'        => 'tidelift',
                'message'      => 'not found',
                'messageColor' => 'red.600',
            ];
        }

        [, $status, $statusColor] = explode('-', parse_url(urldecode($location))['path']);

        return [
            'label'        => 'tidelift',
            'message'      => str_replace('!', '', $status),
            'messageColor' => str_replace('.svg', '', $statusColor),
        ];
    }

    public function service(): string
    {
        return 'Tidelift';
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/tidelift/status/{platform}/{name}',
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
            '/tidelift/status/npm/minimist' => 'subscription',
            '/tidelift/status/npm/got'      => 'subscription',
        ];
    }
}
