<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $app): array
    {
        return $this->client->main($app);
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
            '/scoop/version/{app}',
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
            '/scoop/version/1password-cli' => 'version',
            '/scoop/version/adb'           => 'version',
        ];
    }
}
