<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ModulePdkVersion extends AbstractBadge
{
    public function handle(string $user, string $module): array
    {
        return $this->renderVersion($this->client->module($user, $module)['current_release']['metadata']['pdk-version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/puppetforge/module-pdk-version/{user}/{module}',
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
            '/puppetforge/module-pdk-version/camptocamp/openldap' => 'version',
        ];
    }
}
