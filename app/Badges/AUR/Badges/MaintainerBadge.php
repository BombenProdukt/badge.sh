<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class MaintainerBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->renderLicense($this->client->get($package)['Maintainer']);
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/aur/maintainer/{package}',
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
            '/aur/maintainer/google-chrome' => 'maintainer',
        ];
    }
}
