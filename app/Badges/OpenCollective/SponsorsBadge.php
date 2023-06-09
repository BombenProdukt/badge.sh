<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class SponsorsBadge extends AbstractBadge
{
    protected string $route = '/opencollective/sponsors/{slug}/{tierId?}';

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
            new BadgePreviewData(
                name: 'sponsors',
                path: '/opencollective/sponsors/webpack',
                data: $this->render(['count' => 0]),
            ),
        ];
    }
}
