<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $channel, string $package): array
    {
        return [
            'version' => $this->client->get($channel, $package)['latest_version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/conda/version/{channel}/{package}',
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
            '/conda/version/conda-forge/python' => 'version',
        ];
    }
}
