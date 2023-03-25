<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;

final class ModuleFeedback extends AbstractBadge
{
    protected array $routes = [
        '/puppetforge/module-feedback/{user}/{module}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $user, string $module): array
    {
        return $this->renderNumber('feedback score', $this->client->module($user, $module)['feedback_score']);
    }

    public function render(array $properties): array
    {
        //
    }

    public function previews(): array
    {
        return [
            '/puppetforge/module-feedback/camptocamp/openldap' => 'feedback',
        ];
    }
}
