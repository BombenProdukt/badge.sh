<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;

final class UserModuleCount extends AbstractBadge
{
    protected array $routes = [
        '/puppetforge/user-module-count/{user}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user): array
    {
        return $this->renderNumber('module count', $this->client->user($user)['module_count']);
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
            '/puppetforge/user-module-count/camptocamp' => 'version',
        ];
    }
}
