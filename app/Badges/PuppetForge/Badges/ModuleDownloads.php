<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ModuleDownloads extends AbstractBadge
{
    protected string $route = '/puppetforge/module-downloads/{user}/{module}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'downloads',
                path: '/puppetforge/module-downloads/camptocamp/openldap',
                data: $this->render(['downloads' => '1']),
            ),
        ];
    }
}
