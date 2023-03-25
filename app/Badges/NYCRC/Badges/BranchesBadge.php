<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BranchesBadge extends AbstractBadge
{
    protected array $routes = [
        '/nycrc/branches/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $user, string $repo): array
    {
        return [
            'count' => $this->client->get($user, $repo)['branches'],
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
                path: '/nycrc/branches/yargs/yargs',
                data: $this->render([]),
            ),
        ];
    }
}
