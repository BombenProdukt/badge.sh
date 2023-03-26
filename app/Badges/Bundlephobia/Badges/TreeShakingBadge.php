<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TreeShakingBadge extends AbstractBadge
{
    protected array $routes = [
        '/bundlephobia/tree-shaking/{name:wildcard}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'isTreeShakeable' => $response['hasJSModule'] || $response['hasJSNext'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'tree shaking',
            'message' => $properties['isTreeShakeable'] ? 'supported' : 'not supported',
            'messageColor' => $properties['isTreeShakeable'] ? 'green.600' : 'red.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'tree-shaking support',
                path: '/bundlephobia/tree-shaking/react-colorful',
                data: $this->render(['isTreeShakeable' => true]),
            ),
            new BadgePreviewData(
                name: 'tree-shaking support',
                path: '/bundlephobia/tree-shaking/react-colorful',
                data: $this->render(['isTreeShakeable' => false]),
            ),
        ];
    }
}
