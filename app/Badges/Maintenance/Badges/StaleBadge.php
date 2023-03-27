<?php

declare(strict_types=1);

namespace App\Badges\Maintenance\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StaleBadge extends AbstractBadge
{
    protected string $route = '/maintenance/stale/{year:number}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $year): array
    {
        return [
            'year' => $year,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('stale', $properties['year'], 'blue.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stale',
                path: '/maintenance/stale/2023',
                data: $this->render(['year' => 2023]),
            ),
        ];
    }
}
