<?php

declare(strict_types=1);

namespace App\Badges\GitLab;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ContributorsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/contributors/{repo:wildcard}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'repository/contributors')->header('x-total'),
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
                path: '/gitlab/contributors/graphviz/graphviz',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
