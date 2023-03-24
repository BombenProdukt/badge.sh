<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LatestVersionBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'version' => $this->client->get($package)['max_version'],
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
            '/crates/version/{package}',
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
            '/crates/version/regex' => 'version',
        ];
    }
}
