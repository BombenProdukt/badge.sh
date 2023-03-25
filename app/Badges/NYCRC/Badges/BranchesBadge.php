<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

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
            '/nycrc/branches/yargs/yargs' => 'branches',
        ];
    }
}
