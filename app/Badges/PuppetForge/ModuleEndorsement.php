<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ModuleEndorsement extends AbstractBadge
{
    protected string $route = '/puppetforge/module-endorsement/{user}/{module}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $user, string $module): array
    {
        return $this->client->module($user, $module);
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('endorsement', $properties['endorsement']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'endorsement',
                path: '/puppetforge/module-endorsement/camptocamp/openldap',
                data: $this->render(['endorsement' => 'supported']),
            ),
        ];
    }
}
