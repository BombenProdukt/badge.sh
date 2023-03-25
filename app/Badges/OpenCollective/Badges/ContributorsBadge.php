<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;

final class ContributorsBadge extends AbstractBadge
{
    protected array $routes = [
        '/opencollective/contributors/{slug}',
    ];

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
            '/opencollective/contributors/webpack' => 'contributors',
        ];
    }
}
