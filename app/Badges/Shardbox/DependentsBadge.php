<?php

declare(strict_types=1);

namespace App\Badges\Shardbox;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected string $route = '/shardbox/dependents/{shard}';

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
            new BadgePreviewData(
                name: 'dependents',
                path: '/shardbox/dependents/lucky',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
