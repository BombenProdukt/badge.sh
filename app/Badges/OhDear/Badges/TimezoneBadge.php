<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TimezoneBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ohdear/timezone/{domain}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $domain): array
    {
        return [
            'domain' => $domain,
            'timezone' => $this->client->get($domain)['timezone'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['domain'],
            'message' => $properties['timezone'],
            'messageColor' => 'blue.600',
        ];
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
