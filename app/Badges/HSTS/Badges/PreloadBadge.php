<?php

declare(strict_types=1);

namespace App\Badges\HSTS\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PreloadBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/hsts/preload/{domain}',
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
            'status' => $this->client->status($domain),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('hsts preloaded', $properties['status']);
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
