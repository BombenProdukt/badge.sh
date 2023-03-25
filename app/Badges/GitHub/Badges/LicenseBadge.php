<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;

final class LicenseBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/license/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

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

    public function previews(): array
    {
        return [
            '/github/license/micromatch/micromatch' => 'license',
        ];
    }
}
