<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;

final class ModuleEndorsement extends AbstractBadge
{
    protected array $routes = [
        '/puppetforge/module-endorsement/{user}/{module}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $user, string $module): array
    {
        return $this->renderStatus('endorsement', $this->client->module($user, $module)['endorsement']);
    }

    public function render(array $properties): array
    {
        //
    }

    public function previews(): array
    {
        return [
            '/puppetforge/module-endorsement/camptocamp/openldap' => 'endorsement',
        ];
    }
}
