<?php

declare(strict_types=1);

namespace App\Badges\Ubuntu\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $packageName, ?string $series = null): array
    {
        return [
            'version' => $this->client->version($packageName, $series),
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
            '/ubuntu/version/{packageName}/{series?}',
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
            '/ubuntu/version/ubuntu-wallpapers'        => 'version',
            '/ubuntu/version/ubuntu-wallpapers/bionic' => 'version',
        ];
    }
}
