<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ohdear/status/{domain}/{label}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::MONITORING,
    ];

    public function handle(string $domain, string $label): array
    {
        return [
            'label' => $label,
            'status' => collect($this->client->get($domain)['sites'])->flatten(1)->firstWhere('label', $label)['status'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['label'],
            'message' => $properties['status'],
            'messageColor' => $properties['status'] === 'up' ? 'green.600' : 'red.600',
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
            '/ohdear/status/status.laravel.com/forge.laravel.com' => 'status',
        ];
    }
}
