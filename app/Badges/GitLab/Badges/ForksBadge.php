<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ForksBadge extends AbstractBadge
{
    protected string $route = '/gitlab/forks/{repo:wildcard}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->graphql($repo, 'forksCount')['forksCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('forks', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'forks',
                path: '/gitlab/forks/inkscape/inkscape',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
