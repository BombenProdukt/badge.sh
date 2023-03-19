<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Badges\OhDear\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $domain, string $label): array
    {
        $site = collect($this->client->get($domain)['sites'])->flatten(1)->firstWhere('label', $label);

        return [
            'label'       => $label,
            'status'      => $site['status'],
            'statusColor' => $site['status'] === 'up' ? 'green.600' : 'red.600',
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
            '/ohdear/{domain}/status/{label}',
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
            '/ohdear/status.laravel.com/status/forge.laravel.com' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
