<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class EntitiesBadge extends AbstractBadge
{
    protected array $routes = [
        '/weblate/entities/{type:components,projects,users,languages}',
    ];

    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $type): array
    {
        return [
            'type' => $type,
            'count' => $this->client->entity($type)['count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['type'], $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'components',
                path: '/weblate/entities/components',
                data: $this->render(['type' => 'components', 'count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'languages',
                path: '/weblate/entities/languages',
                data: $this->render(['type' => 'languages', 'count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'projects',
                path: '/weblate/entities/projects',
                data: $this->render(['type' => 'projects', 'count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'users',
                path: '/weblate/entities/users',
                data: $this->render(['type' => 'users', 'count' => '1000']),
            ),
        ];
    }
}
