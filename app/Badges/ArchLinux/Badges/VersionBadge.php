<?php

declare(strict_types=1);

namespace App\Badges\ArchLinux\Badges;

use App\Badges\AbstractBadge;
use App\Badges\ArchLinux\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repository, string $architecture, string $package): array
    {
        return $this->renderVersion($this->client->get($repository, $architecture, $package)['pkgver']);
    }

    public function service(): string
    {
        return 'Arch Linux';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/arch-linux/version/{repository}/{architecture}/{package}',
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
            '/arch-linux/version/core/x86_64/pacman' => 'version',
        ];
    }
}
