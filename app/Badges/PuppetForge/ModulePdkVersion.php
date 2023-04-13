<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ModulePdkVersion extends AbstractBadge
{
    protected string $route = '/puppetforge/module-pdk-version/{user}/{module}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user, string $module): array
    {
        return [
            'version' => $this->client->module($user, $module)['current_release']['metadata']['pdk-version'],
        ];
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
                path: '/puppetforge/module-pdk-version/camptocamp/openldap',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
