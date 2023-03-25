<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class ContributorsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/contributors/{owner}/{repo}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $owner, string $repo): array
    {
        return [
            'count' => \count(GitHub::api('repo')->contributors($owner, $repo)),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('contributors', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'contributors',
                path: '/github/contributors/micromatch/micromatch',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
