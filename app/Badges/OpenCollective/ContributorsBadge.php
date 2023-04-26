<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ContributorsBadge extends AbstractBadge
{
    protected string $route = '/opencollective/contributors/{slug}';

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $slug): array
    {
        return [
            'count' => $this->client->get($slug)['contributorsCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('contributors', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'contributors',
                path: '/opencollective/contributors/webpack',
                data: $this->render(['count' => 1]),
            ),
        ];
    }
}
