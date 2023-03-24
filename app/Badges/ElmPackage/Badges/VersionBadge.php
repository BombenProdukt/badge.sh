<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        $version = $this->client->get($project)['version'];

        return $this->renderVersion($version);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/elm-package/version/{project}',
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
            '/elm-package/version/avh4/elm-color' => 'version',
        ];
    }
}
