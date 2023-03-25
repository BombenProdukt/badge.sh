<?php

declare(strict_types=1);

namespace App\Badges\FreeCodeCamp\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PointsBadge extends AbstractBadge
{
    protected array $routes = [
        '/freecodecamp/points/{username}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $username): array
    {
        return $this->client->get($username)['entities']['user'][$username];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('freecodecamp', $properties['points']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'points',
                path: '/freecodecamp/points/sethi',
                data: $this->render(['points' => 0]),
            ),
        ];
    }
}
