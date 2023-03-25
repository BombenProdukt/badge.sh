<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ModuleVersion extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/puppetforge/module-version/{user}/{module}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user, string $module): array
    {
        return $this->renderVersion($this->client->module($user, $module)['current_release']['version']);
    }

    public function render(array $properties): array
    {
        //
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
            '/puppetforge/module-version/camptocamp/openldap' => 'version',
        ];
    }
}
