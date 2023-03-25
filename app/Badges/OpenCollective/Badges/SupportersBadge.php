<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;

final class SupportersBadge extends AbstractBadge
{
    protected array $routes = [
        '/opencollective/supporters/{slug}/{tierId?}',
    ];

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $slug, ?string $tierId = null): array
    {
        return [
            'count' => $this->client->fetchCollectiveBackersCount($slug, 'all', $tierId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('supporters', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/opencollective/supporters/webpack' => 'supporters',
        ];
    }
}
