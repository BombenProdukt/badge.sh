<?php

declare(strict_types=1);

namespace App\Badges\Gitter\Badges;

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
        '/gitter/status/{org}/{room}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $org, string $room): array
    {
        return [];
    }

    public function render(array $properties): array
    {
        return $this->renderText('gitter', 'on gitter', 'ed1965');
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
            '/gitter/status/redom/lobby' => 'status',
            '/gitter/status/redom/redom' => 'status',
        ];
    }
}
