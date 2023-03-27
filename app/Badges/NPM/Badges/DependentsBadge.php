<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected string $route = '/npm/dependents/{package:packageWithScope}/{tag?}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->web("package/{$package}");

        \preg_match('/"dependentsCount"\s*:\s*(\d+)/', $response, $matches);

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
                path: '/npm/dependents/got',
                data: $this->render(['count' => 1000000000]),
            ),
        ];
    }
}
