<?php

declare(strict_types=1);

namespace App\Badges\NYCRC\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FunctionsBadge extends AbstractBadge
{
    protected array $routes = [
        '/nycrc/functions/{user}/{repo}',
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
        return $this->renderText('functions', $properties['functions'] ?? 0);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'functions',
                path: '/nycrc/functions/yargs/yargs',
                data: $this->render([]),
            ),
        ];
    }
}
