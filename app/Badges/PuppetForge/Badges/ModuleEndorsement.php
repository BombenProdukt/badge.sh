<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ModuleEndorsement extends AbstractBadge
{
    public function handle(string $user, string $module): array
    {
        return $this->renderStatus('endorsement', $this->client->module($user, $module)['endorsement']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/puppetforge/module-endorsement/{user}/{module}',
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
            '/puppetforge/module-endorsement/camptocamp/openldap' => 'endorsement',
        ];
    }
}
