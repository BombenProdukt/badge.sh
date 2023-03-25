<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class BackersBadge extends AbstractBadge
{
    protected array $routes = [
        '/opencollective/backers/{slug}/{tierId?}',
    ];

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $slug, ?string $tierId = null): array
    {
        return [
            'count' => $this->client->fetchCollectiveBackersCount($slug, 'users', $tierId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('backers', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'backers',
                path: '/opencollective/backers/webpack',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
