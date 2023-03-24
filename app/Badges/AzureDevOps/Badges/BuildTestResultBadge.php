<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AzureDevOps\Client;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;
use PreemStudio\Formatter\FormatNumber;

final class BuildTestResultBadge extends AbstractBadge
{
    private array $colors = [
        'completed'          => 'green.600',
        'succeeded'          => 'green.600',
        'partiallySucceeded' => 'yellow.600',
        'failed'             => 'red.600',
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $organization, string $project, string $definition, ?string $branch = null): array
    {
        $latestBuild = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/build/builds", array_merge([
            'api-version'  => '6.0',
            '$top'         => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ], $branch ? ['branchName' => "refs/heads/{$branch}"] : []))->json('value.0');

        $response = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/test/ResultSummaryByBuild", [
            'api-version'  => '6.0-preview',
            'buildId'      => $latestBuild['id'],
        ])->json('aggregatedResultsAnalysis');

        $passed  = $response['resultsByOutcome']['Passed']['count'] ?? 0;
        $failed  = $response['resultsByOutcome']['Failed']['count'] ?? 0;
        $ignored = $response['resultsByOutcome']['NotExecuted']['count'] ?? $response['totalTests'] - $passed - $failed;

        $status = collect([
            $passed ? FormatNumber::execute($passed).' passed' : null,
            $failed ? FormatNumber::execute($failed).' failed' : null,
            $ignored ? FormatNumber::execute($ignored).' skipped' : null,
        ])->filter()->implode(', ') ?: 'unknown';

        if ($response['totalTests'] === $passed) {
            $color = $this->colors['succeeded'];
        } elseif ($response['totalTests'] === $failed) {
            $color = $this->colors['failed'];
        } else {
            $color = $this->colors['partiallySucceeded'];
        }

        return [
            'label'        => 'Test',
            'message'      => $status,
            'messageColor' => $color,
        ];
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
            '/azure-devops/build-test/{organization}/{project}/{definition}/{branch?}',
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
            '/azure-devops/build-test/dnceng/public/51'                                => 'test results',
            '/azure-devops/build-test/azuredevops-powershell/azuredevops-powershell/1' => 'test results',
        ];
    }
}