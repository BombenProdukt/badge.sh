<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Badges\AbstractBadge;
use App\Badges\OhDear\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TimezoneBadge extends AbstractBadge
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
        return [Category::MONITORING];
    }

    public function routePaths(): array
    {
        return [
            '/ohdear/timezone/{domain}',
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
            '/ohdear/timezone/status.laravel.com' => 'timezone',
        ];
    }
}
