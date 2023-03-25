<?php

declare(strict_types=1);

namespace App\Badges\Codacy\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CoverageBadge extends AbstractBadge
{
    protected array $routes = [
        '/codacy/coverage/{projectId}/{branch?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $projectId, ?string $branch = null): array
    {
        \preg_match('/text-anchor=[^>]*?>([^<]+)<\//i', $this->client->get('coverage', $projectId, $branch), $matches);

        return [
            'percentage' => \trim($matches[1]),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage',
                path: '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e',
                data: $this->render(['percentage' => '66.66']),
            ),
            new BadgePreviewData(
                name: 'branch coverage',
                path: '/codacy/coverage/f0875490cea1497a9eca9c25f3f7774e/master',
                data: $this->render(['percentage' => '66.66']),
            ),
        ];
    }
}
