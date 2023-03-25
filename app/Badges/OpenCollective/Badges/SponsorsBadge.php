<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;

final class SponsorsBadge extends AbstractBadge
{
    protected array $routes = [
        '/opencollective/sponsors/{slug}/{tierId?}',
    ];

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $slug, ?string $tierId = null): array
    {
        return [
            'count' => $this->client->fetchCollectiveBackersCount($slug, 'organizations', $tierId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('sponsors', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/opencollective/sponsors/webpack' => 'sponsors',
        ];
    }
}
