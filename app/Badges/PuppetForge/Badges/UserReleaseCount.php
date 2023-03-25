<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;

final class UserReleaseCount extends AbstractBadge
{
    protected array $routes = [
        '/puppetforge/user-release-count/{user}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $user): array
    {
        return $this->renderNumber('release count', $this->client->user($user)['release_count']);
    }

    public function render(array $properties): array
    {
        //
    }

    public function previews(): array
    {
        return [
            '/puppetforge/user-release-count/camptocamp' => 'version',
        ];
    }
}
