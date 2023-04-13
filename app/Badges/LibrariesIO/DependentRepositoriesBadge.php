<?php

declare(strict_types=1);

namespace App\Badges\LibrariesIO;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependentRepositoriesBadge extends AbstractBadge
{
    protected string $route = '/libraries-io/dependent-repositories/{platform}/{package:wildcard}';

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    public function handle(string $platform, string $package): array
    {
        return [
            'count' => $this->client->get($platform, $package)['dependent_repos_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependent repositories', $properties['count']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependent repositories',
                path: '/libraries-io/dependent-repositories/npm/got',
                data: $this->render(['count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'dependent repositories (scoped)',
                path: '/libraries-io/dependent-repositories/npm/@babel/core',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
