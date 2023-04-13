<?php

declare(strict_types=1);

namespace App\Badges\Treeware;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CountBadge extends AbstractBadge
{
    protected string $route = '/treeware/trees/{owner}/{packageName}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'tree count',
                path: '/treeware/trees/stoplightio/spectral',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
