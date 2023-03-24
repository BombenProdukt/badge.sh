<?php

declare(strict_types=1);

namespace App\Badges\OPM\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $user, string $moduleName): array
    {
        return [
            'version' => Regex::match("/{$moduleName}-(.+).opm/", $this->client->version($user, $moduleName))->group(1),
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
            '/opm/version/{user}/{moduleName}',
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
            '/opm/version/openresty/lua-resty-lrucache' => 'version',
        ];
    }
}
