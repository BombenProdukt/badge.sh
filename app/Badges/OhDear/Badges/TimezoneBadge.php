<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Badges\OhDear\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class TimezoneBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $domain): array
    {
        return [
            'label'        => $domain,
            'message'      => $this->client->get($domain)['timezone'],
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Oh Dear';
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
            '/ohdear/{domain}/timezone',
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
            '/ohdear/status.laravel.com/timezone' => 'timezone',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
