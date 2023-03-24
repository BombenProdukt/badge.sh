<?php

declare(strict_types=1);

namespace App\Badges\OpenSuseBuildService\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $project, string $packageName, string $repository, string $arch): array
    {
        return $this->renderStatus('build status', $this->client->get($project, $packageName, $repository, $arch)['License']);
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/open-suse-build-service/status/{project}/{packageName}/{repository}/{arch}',
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
            '/open-suse-build-service/status/openSUSE:Tools/osc/Debian_111/x86_64' => 'build status',
        ];
    }
}
