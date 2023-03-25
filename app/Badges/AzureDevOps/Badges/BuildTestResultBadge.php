<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Enums\Category;
use Illuminate\Support\Facades\Http;
use PreemStudio\Formatter\FormatNumber;

final class BuildTestResultBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/azure-devops/build-test/{organization}/{project}/{definition}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::BUILD,
    ];
    private array $colors = [
        'completed' => 'green.600',
        'succeeded' => 'green.600',
        'partiallySucceeded' => 'yellow.600',
        'failed' => 'red.600',
    ];

    public function handle(string $organization, string $project, string $definition, ?string $branch = null): array
    {
        $latestBuild = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/build/builds", \array_merge([
            'api-version' => '6.0',
            '$top' => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ], $branch ? ['branchName' => "refs/heads/{$branch}"] : []))->json('value.0');

        $response = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/test/ResultSummaryByBuild", [
            'api-version' => '6.0-preview',
            'buildId' => $latestBuild['id'],
        ])->json('aggregatedResultsAnalysis');

        $passed = $response['resultsByOutcome']['Passed']['count'] ?? 0;
        $failed = $response['resultsByOutcome']['Failed']['count'] ?? 0;

        return [
            'failed' => $failed,
            'ignored' => $response['resultsByOutcome']['NotExecuted']['count'] ?? $response['totalTests'] - $passed - $failed,
            'passed' => $passed,
            'total' => $response['totalTests'],
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['total'] === $properties['passed']) {
            $color = $this->colors['succeeded'];
        } elseif ($properties['total'] === $properties['failed']) {
            $color = $this->colors['failed'];
        } else {
            $color = $this->colors['partiallySucceeded'];
        }

        return [
            'label' => 'Test',
            'message' => collect([
                $properties['passed'] ? FormatNumber::execute($properties['passed']).' passed' : null,
                $properties['failed'] ? FormatNumber::execute($properties['failed']).' failed' : null,
                $properties['ignored'] ? FormatNumber::execute($properties['ignored']).' skipped' : null,
            ])->filter()->implode(', ') ?: 'unknown',
            'messageColor' => $color,
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
            '/azure-devops/build-test/dnceng/public/51' => 'test results',
            '/azure-devops/build-test/azuredevops-powershell/azuredevops-powershell/1' => 'test results',
        ];
    }
}
