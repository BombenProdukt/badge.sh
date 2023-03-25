<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Cache;

final class ShowBadgeBadge extends AbstractBadge
{
    protected array $routes = [
        '/memo/{name}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $name): array
    {
        return Cache::get($name);
    }

    public function render(array $properties): array
    {
        //
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'memoized badge for deploy status',
                path: '/memo/deployed',
                data: $this->render([]),
            ),
        ];
    }
}
