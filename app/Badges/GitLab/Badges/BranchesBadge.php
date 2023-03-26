<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BranchesBadge extends AbstractBadge
{
    protected array $routes = [
        '/gitlab/branches/{repo:wildcard}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->rest($repo, 'repository/branches')->header('x-total'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('branches', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'branches',
                path: '/gitlab/branches/gitterHQ/webapp',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
