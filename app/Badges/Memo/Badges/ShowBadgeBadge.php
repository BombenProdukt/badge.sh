<?php

declare(strict_types=1);

namespace App\Badges\Memo\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/memo/deployed' => 'memoized badge for deploy status',
        ];
    }
}
