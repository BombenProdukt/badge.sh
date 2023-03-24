<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PuppetForge\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class UserModuleCount extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user): array
    {
        return $this->renderNumber('module count', $this->client->user($user)['module_count']);
    }

    public function service(): string
    {
        return 'Puppet Forge';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/puppetforge/user-module-count/{user}',
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
            '/puppetforge/user-module-count/camptocamp' => 'version',
        ];
    }
}
