<?php

declare(strict_types=1);

namespace App\Badges\PyPI\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        $version = $this->client->get($project)['info']['version'];

        return $this->renderVersion($version);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/pypi/version/{project}',
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
            '/pypi/version/pip'      => 'version',
            '/pypi/version/docutils' => 'version',
        ];
    }
}
