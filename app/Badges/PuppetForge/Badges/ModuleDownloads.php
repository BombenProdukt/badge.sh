<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;

final class ModuleDownloads extends AbstractBadge
{
    protected array $routes = [
        '/puppetforge/module-downloads/{user}/{module}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $user, string $module): array
    {
        return $this->client->module($user, $module);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/puppetforge/module-downloads/camptocamp/openldap' => 'downloads',
        ];
    }
}
