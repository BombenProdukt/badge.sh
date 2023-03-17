<?php

declare(strict_types=1);

namespace App\Integrations\AzurePipelines\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\AzurePipelines\Client;
use Illuminate\Support\Facades\Http;

final class DeploymentController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $org, string $project, string $definition, ?string $environment = null): array
    {
        $response = Http::get("https://vsrm.dev.azure.com/{$org}/{$project}/_apis/release/deployments", array_merge([
            'api-version'      => '6.0',
            '$top'             => '1',
            'definitionId'     => $definition,
            'deploymentStatus' => 'succedeed',
        ], $environment ? ['definitionEnvironmentId' => 'environment'] : []))->json('value.0');

        return [
            'label'       => 'Deployment Version',
            'status'      => $response['release']['name'],
            'statusColor' => [
                'succeeded'          => 'green.600',
                'partiallySucceeded' => 'yellow.600',
                'failed'             => 'red.600',
            ][$response['deploymentStatus']],
        ];
    }
}
