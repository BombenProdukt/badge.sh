<?php

declare(strict_types=1);

namespace App\Badges\Treeware\Badges;

use App\Enums\Category;

final class CountBadge extends AbstractBadge
{
    protected array $routes = [
        '/treeware/trees/{owner}/{packageName}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $owner, string $packageName): array
    {
        return [
            'count' => $this->client->get($owner, $packageName),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('trees', $properties['count']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/treeware/trees/stoplightio/spectral' => 'tree count',
        ];
    }
}
