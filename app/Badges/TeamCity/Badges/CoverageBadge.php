<?php

declare(strict_types=1);

namespace App\Badges\TeamCity\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class CoverageBadge extends AbstractBadge
{
    protected array $routes = [
        '/team-city/coverage/{buildId}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $buildId): array
    {
        $response = $this->client->coverage($this->getRequestData('instance'), $buildId);

        $total = null;
        $covered = null;

        foreach ($response['property'] as $property) {
            if ($property['name'] === 'CodeCoverageAbsSCovered') {
                $covered = (int) $property['value'];
            }

            if ($property['name'] === 'CodeCoverageAbsSTotal') {
                $total = (int) $property['value'];
            }
        }

        if ($covered !== null && $total !== null) {
            $coverage = $covered ? ($covered / $total) * 100 : 0;
        }

        return [
            'percentage' => $coverage ?? 0,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage']);
    }

    public function routeRules(): array
    {
        return [
            'instance' => ['required', 'url'],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'coverage status',
                path: '/team-city/coverage/ReactJSNet_PullRequests?instance=https://teamcity.jetbrains.com',
                data: $this->render([]),
            ),
        ];
    }
}
