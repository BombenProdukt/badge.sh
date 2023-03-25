<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Actions\RequestDependents;
use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PackageDependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/dependents-package/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return RequestDependents::execute($owner, $repo, 'PACKAGE');
    }

    public function render(array $properties): array
    {
        return $properties;
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'package dependents',
                path: '/github/dependents-package/micromatch/micromatch',
                data: $this->render([]),
            ),
        ];
    }
}
