<?php

declare(strict_types=1);

namespace App\Badges\Sourcegraph\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected string $route = '/sourcegraph/dependents/{repo:wildcard}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $repo): array
    {
        return [
            'count' => $this->client->dependents($repo),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('used by', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependents',
                path: '/sourcegraph/dependents/github.com/gorilla/mux',
                data: $this->render(['count' => 1000000000]),
            ),
        ];
    }
}
