<?php

declare(strict_types=1);

namespace App\Badges\Shardbox\Badges;

use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected array $routes = [
        '/shardbox/dependents/{shard}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $shard): array
    {
        \preg_match('/Dependents[^>]*? class="count">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'count' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependents', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/shardbox/dependents/lucky' => 'dependents',
        ];
    }
}
