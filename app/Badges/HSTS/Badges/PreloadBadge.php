<?php

declare(strict_types=1);

namespace App\Badges\HSTS\Badges;

use App\Badges\HSTS\Client;
use App\Badges\Templates\StatusTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class PreloadBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $domain): array
    {
        return StatusTemplate::make('hsts preloaded', $this->client->status($domain));
    }

    public function service(): string
    {
        return 'HSTS';
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
            '/hsts/preload/{domain}',
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
            '/hsts/preload/github.com' => 'status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
