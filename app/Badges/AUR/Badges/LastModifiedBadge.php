<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'date' => $this->client->get($package)['LastModified'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('last modified', $properties['date']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/aur/last-modified/{package}',
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
            '/aur/last-modified/google-chrome' => 'last modified',
        ];
    }
}
