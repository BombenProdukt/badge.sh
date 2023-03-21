<?php

declare(strict_types=1);

namespace App\Badges\HSTS\Badges;

use App\Badges\AbstractBadge;
use App\Badges\HSTS\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class PreloadBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $domain): array
    {
        return $this->renderStatus('hsts preloaded', $this->client->status($domain));
    }

    public function service(): string
    {
        return 'HSTS';
    }

    public function keywords(): array
    {
        return [Category::MONITORING];
    }

    public function routePaths(): array
    {
        return [
            '/hsts/preload/{domain}',
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
            '/hsts/preload/github.com' => 'status',
        ];
    }
}
