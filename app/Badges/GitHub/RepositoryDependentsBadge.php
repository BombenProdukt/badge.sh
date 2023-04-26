<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RepositoryDependentsBadge extends AbstractBadge
{
    protected string $route = '/github/dependents-repo/{owner}/{repo}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return $this->requestDependents($owner, $repo, 'REPOSITORY');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'repository dependents',
                path: '/github/dependents-repo/micromatch/micromatch',
                data: $this->render([
                    'label' => 'dependents',
                    'message' => '100',
                    'messageColor' => 'blue.600',
                ]),
            ),
        ];
    }
}
