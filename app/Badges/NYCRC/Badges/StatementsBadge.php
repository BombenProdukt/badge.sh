<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatementsBadge extends AbstractBadge
{
    protected array $routes = [
        '/nycrc/statements/{user}/{repo}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $user, string $repo): array
    {
        return $this->client->get($user, $repo);
    }

    public function render(array $properties): array
    {
        return $this->renderText('statements', $properties['statements'] ?? 0);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'statements',
                path: '/nycrc/statements/yargs/yargs',
                data: $this->render([]),
            ),
        ];
    }
}
