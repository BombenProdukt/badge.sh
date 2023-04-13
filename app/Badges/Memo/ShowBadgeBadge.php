<?php

declare(strict_types=1);

namespace App\Badges\Memo;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Cache;

final class ShowBadgeBadge extends AbstractBadge
{
    protected string $route = '/memo/{name}';

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $name): array
    {
        return Cache::get($name);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'memoized badge for deploy status',
                path: '/memo/deployed',
                data: $this->render([
                    'label' => 'deployed',
                    'message' => 'yes',
                    'messageColor' => 'green.600',
                ]),
            ),
        ];
    }
}
