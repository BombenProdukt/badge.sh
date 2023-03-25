<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TreeBadge extends AbstractBadge
{
    protected array $routes = [
        '/ecologi/trees/{username}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $username): array
    {
        return [
            'count' => $this->client->trees($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('trees', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/ecologi/trees/ecologi',
                data: $this->render([]),
            ),
        ];
    }
}
