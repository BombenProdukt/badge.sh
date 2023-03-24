<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ModuleFeedback extends AbstractBadge
{
    public function handle(string $user, string $module): array
    {
        return $this->renderNumber('feedback score', $this->client->module($user, $module)['feedback_score']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/puppetforge/module-feedback/{user}/{module}',
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
            '/puppetforge/module-feedback/camptocamp/openldap' => 'feedback',
        ];
    }
}
