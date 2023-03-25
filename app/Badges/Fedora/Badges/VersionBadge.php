<?php

declare(strict_types=1);

namespace App\Badges\Fedora\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $packageName, ?string $branch = 'rawhide'): array
    {
        return [
            'version' => $this->client->version($packageName, $branch),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/fedora/version/{packageName}/{branch?}',
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
            '/fedora/version/rpm' => 'version',
            '/fedora/version/rpm/rawhide' => 'version',
        ];
    }
}
