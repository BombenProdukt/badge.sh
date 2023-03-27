<?php

declare(strict_types=1);

namespace App\Badges\Maintenance\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class AbandonedBadge extends AbstractBadge
{
    protected string $route = '/maintenance/abandoned/{year:number}';

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $year): array
    {
        return ['year' => $year];
    }

    public function render(array $properties): array
    {
        return $this->renderText('abandoned', $properties['year'], 'red.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'abandoned',
                path: '/maintenance/abandoned/2023',
                data: $this->render(['year' => 2023]),
            ),
        ];
    }
}
