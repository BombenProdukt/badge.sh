<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class CoverageBadge extends AbstractBadge
{
    protected string $route = '/azure-devops/coverage/{organization}/{project}/{definition}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $organization, string $project, string $definition, ?string $environment = null): array
    {
        $buildId = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/build/builds", [
            'api-version' => '6.0',
            '$top' => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ])->json('value.0.id');

        $coverageData = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/test/codecoverage", [
            'api-version' => '6.0',
            'buildId' => $buildId,
        ])->json('coverageData');

        $covered = 0;
        $total = 0;

        foreach ($coverageData as $cd) {
            foreach ($cd['coverageStats'] as $coverageStat) {
                if ($coverageStat['label'] === 'Line' || $coverageStat['label'] === 'Lines') {
                    $covered += $coverageStat['covered'];
                    $total += $coverageStat['total'];
                }
            }
        }

        return [
            'percentage' => $covered ? ($covered / $total) * 100 : 0,
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
                name: 'test coverage',
                path: '/azure-devops/coverage/swellaby/opensource/25',
                data: $this->render(['percentage' => '66.66']),
            ),
        ];
    }
}
