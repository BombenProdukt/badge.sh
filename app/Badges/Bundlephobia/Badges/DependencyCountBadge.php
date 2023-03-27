<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependencyCountBadge extends AbstractBadge
{
    protected string $route = '/bundlephobia/dependency-count/{name:wildcard}';

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $name): array
    {
        return [
            'count' => $this->client->get($name)['dependencyCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependency count', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependency count',
                path: '/bundlephobia/dependency-count/react',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
