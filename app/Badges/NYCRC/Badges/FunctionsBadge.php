<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FunctionsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/nycrc/functions/{user}/{repo}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $user, string $repo): array
    {
        return $this->client->get($user, $repo);
    }

    public function render(array $properties): array
    {
        return $this->renderText('functions', $properties['functions'] ?? 0);
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
            '/nycrc/functions/yargs/yargs' => 'functions',
        ];
    }
}
