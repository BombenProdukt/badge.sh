<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TagsBadge extends AbstractBadge
{
    protected string $route = '/gitlab/tags/{repo:wildcard}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'repository/tags')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('tags', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'tags',
                path: '/gitlab/tags/commento/commento',
                data: $this->render(['count' => '1']),
            ),
        ];
    }
}
