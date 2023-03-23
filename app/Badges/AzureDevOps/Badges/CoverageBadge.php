<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AzureDevOps\Client;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class CoverageBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $organization, string $project, string $definition, ?string $environment = null): array
    {
        $buildId = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/build/builds", [
            'api-version'  => '6.0',
            '$top'         => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ])->json('value.0.id');

        $coverageData = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/test/codecoverage", [
            'api-version' => '6.0',
            'buildId'     => $buildId,
        ])->json('coverageData');

        $covered = 0;
        $total   = 0;

        foreach ($coverageData as $cd) {
            foreach ($cd['coverageStats'] as $coverageStat) {
                if ($coverageStat['label'] === 'Line' || $coverageStat['label'] === 'Lines') {
                    $covered += $coverageStat['covered'];
                    $total += $coverageStat['total'];
                }
            }
        }

        return $this->renderCoverage($covered ? ($covered / $total) * 100 : 0);
    }

    public function service(): string
    {
        return 'Azure Pipelines';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/azure-devops/coverage/{organization}/{project}/{definition}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/azure-devops/coverage/swellaby/opensource/25' => 'test coverage',
        ];
    }
}
