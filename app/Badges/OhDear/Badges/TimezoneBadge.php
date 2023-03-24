<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TimezoneBadge extends AbstractBadge
{
    public function handle(string $domain): array
    {
        return [
            'domain'   => $domain,
            'timezone' => $this->client->get($domain)['timezone'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => $properties['domain'],
            'message'      => $properties['timezone'],
            'messageColor' => 'blue.600',
        ];
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
