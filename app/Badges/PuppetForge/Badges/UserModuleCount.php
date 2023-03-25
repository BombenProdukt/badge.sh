<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UserModuleCount extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/puppetforge/user-module-count/{user}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user): array
    {
        return $this->renderNumber('module count', $this->client->user($user)['module_count']);
    }

    public function render(array $properties): array
    {
        //
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
            '/puppetforge/user-module-count/camptocamp' => 'version',
        ];
    }
}
