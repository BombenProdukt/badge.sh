<?php

declare(strict_types=1);

namespace App\Badges\HackerNews\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class KarmaBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/hackernews/karma/{username}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $username): array
    {
        return [
            'username' => $username,
            'karma' => $this->client->karma($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('u/'.$properties['username'].' karma', $properties['karma']);
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
            '/hackernews/karma/pg' => 'karma',
        ];
    }
}
