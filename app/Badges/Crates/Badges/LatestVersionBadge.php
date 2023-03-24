<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LatestVersionBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $version = $this->client->get($package)['max_version'];

        return $this->renderVersion($version);
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
