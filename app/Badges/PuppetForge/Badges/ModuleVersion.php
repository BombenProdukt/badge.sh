<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Data\BadgePreviewData;
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
        return $this->client->module($user, $module)['current_release'];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/puppetforge/module-version/camptocamp/openldap',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
