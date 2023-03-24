<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UserReleaseCount extends AbstractBadge
{
    public function handle(string $user): array
    {
        return $this->renderNumber('release count', $this->client->user($user)['release_count']);
    }

    public function render(array $properties): array
    {
        //
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/puppetforge/user-release-count/{user}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
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
            '/puppetforge/user-release-count/camptocamp' => 'version',
        ];
    }
}
