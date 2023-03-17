<?php

declare(strict_types=1);

namespace App\Integrations\AzurePipelines\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\AzurePipelines\Client;
use Illuminate\Support\Facades\Http;

final class BuildTestResultController extends AbstractController
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

    protected function handleRequest(string $org, string $project, string $definition, ?string $branch = null): array
    {
        $latestBuild = Http::get("https://dev.azure.com/{$org}/{$project}/_apis/build/builds", array_merge([
            'api-version'  => '6.0',
            '$top'         => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ], $branch ? ['branchName' => "refs/heads/{$branch}"] : []))->json('value.0');

        $response = Http::get("https://dev.azure.com/{$org}/{$project}/_apis/test/ResultSummaryByBuild", [
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
            'label'       => 'Test',
            'status'      => $status,
            'statusColor' => $color,
        ];
    }
}
