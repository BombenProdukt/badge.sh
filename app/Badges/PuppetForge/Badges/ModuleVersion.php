<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PuppetForge\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class ModuleVersion extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $module): array
    {
        return $this->renderVersion($this->client->module($user, $module)['current_release']['version']);
    }

    public function service(): string
    {
        return 'Puppet Forge';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/puppetforge/module-version/{user}/{module}',
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
            '/puppetforge/module-version/camptocamp/openldap' => 'version',
        ];
    }
}
