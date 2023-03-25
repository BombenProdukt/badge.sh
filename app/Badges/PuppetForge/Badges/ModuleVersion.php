<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;

final class ModuleVersion extends AbstractBadge
{
    protected array $routes = [
        '/puppetforge/module-version/{user}/{module}',
    ];

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
