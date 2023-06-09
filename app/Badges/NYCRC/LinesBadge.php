<?php

declare(strict_types=1);

namespace App\Badges\NYCRC;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LinesBadge extends AbstractBadge
{
    protected string $route = '/nycrc/lines/{user}/{repo}';

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $user, string $repo): array
    {
        return $this->client->get($user, $repo);
    }

    public function render(array $properties): array
    {
        return $this->renderText('lines', $properties['lines'] ?? 0);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'lines',
                path: '/nycrc/lines/yargs/yargs',
                data: $this->render(['lines' => 1]),
            ),
        ];
    }
}
