<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected array $routes = [
        '/apm/stars/{package}',
    ];

    protected array $keywords = [
        Category::RATING,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $package): array
    {
        return [
            'stars' => $this->client->get($package)['stargazers_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/apm/stars/linter',
                data: $this->render(['stars' => '4.5']),
            ),
        ];
    }
}
