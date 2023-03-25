<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;

final class ModulePdkVersion extends AbstractBadge
{
    protected array $routes = [
        '/puppetforge/module-pdk-version/{user}/{module}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user, string $module): array
    {
        return $this->renderVersion($this->client->module($user, $module)['current_release']['metadata']['pdk-version']);
    }

    public function render(array $properties): array
    {
        //
    }

    public function previews(): array
    {
        return [
            '/puppetforge/module-pdk-version/camptocamp/openldap' => 'version',
        ];
    }
}
