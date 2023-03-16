<?php

declare(strict_types=1);

namespace App\Integrations\AzurePipelines\Controllers;

use App\Integrations\AzurePipelines\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class BuildVersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $org, string $project, string $definition, ?string $branch = null): array
    {
        $response = Http::get("https://dev.azure.com/{$org}/{$project}/_apis/build/builds", array_merge([
            'api-version'  => '6.0',
            '$top'         => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ], $branch ? ['branchName' => "refs/heads/{$branch}"] : []))->json('value.0');

        return [
            'label'       => 'Build Version',
            'status'      => $response['buildNumber'],
            'statusColor' => [
                'completed'          => 'green.600',
                'succeeded'          => 'green.600',
                'partiallySucceeded' => 'yellow.600',
                'failed'             => 'red.600',
            ][$response['status']],
        ];
    }
}
