<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;

final class RankBadge extends AbstractBadge
{
    protected array $routes = [
        '/package-control/rank/{packageName}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $packageName): array
    {
        return [
            'rank' => $this->client->get($packageName)['installs_rank'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('rank', $properties['rank']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/package-control/rank/GitGutter' => 'rank',
        ];
    }
}
