<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UsersBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/discourse/users/{server}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $server): array
    {
        return [
            'count' => $this->client->statistics($server)['user_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('users', $properties['count']);
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
            '/discourse/users/meta.discourse.org' => 'users',
        ];
    }
}
