<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PackageDependentsBadge extends AbstractBadge
{
    protected string $route = '/github/dependents-package/{owner}/{repo}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return $this->requestDependents($owner, $repo, 'PACKAGE');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'package dependents',
                path: '/github/dependents-package/micromatch/micromatch',
                data: $this->render([
                    'label' => 'dependents',
                    'message' => '100',
                    'messageColor' => 'blue.600',
                ]),
            ),
        ];
    }
}
