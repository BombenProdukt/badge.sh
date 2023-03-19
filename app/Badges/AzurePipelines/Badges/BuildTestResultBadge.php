<?php

declare(strict_types=1);

namespace App\Badges\AzurePipelines\Badges;

use App\Badges\AzurePipelines\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;
use PreemStudio\Formatter\FormatNumber;

final class BuildTestResultBadge implements Badge
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

    public function handle(string $project, string $definition, ?string $branch = null): array
    {
        $latestBuild = Http::get("https://dev.azure.com/{$project}/_apis/build/builds", array_merge([
            'api-version'  => '6.0',
            '$top'         => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ], $branch ? ['branchName' => "refs/heads/{$branch}"] : []))->json('value.0');

        $response = Http::get("https://dev.azure.com/{$project}/_apis/test/ResultSummaryByBuild", [
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

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/azure-pipelines/{project}/build/test/{definition}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/azure-pipelines/dnceng/public/build/test/51'                                => 'test results',
            '/azure-pipelines/azuredevops-powershell/azuredevops-powershell/build/test/1' => 'test results',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
