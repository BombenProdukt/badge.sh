<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RankBadge extends AbstractBadge
{
    protected string $route = '/package-control/rank/{packageName}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rank',
                path: '/package-control/rank/GitGutter',
                data: $this->render(['rank' => 0]),
            ),
        ];
    }
}
