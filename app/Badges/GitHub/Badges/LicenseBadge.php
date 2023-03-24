<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'licenseInfo { spdxId }');

        return [
            'license' => $result['licenseInfo']['spdxId'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/github/license/{owner}/{repo}',
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
            '/github/license/micromatch/micromatch' => 'license',
        ];
    }
}
