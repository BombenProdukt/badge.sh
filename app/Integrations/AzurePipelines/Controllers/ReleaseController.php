<?php

declare(strict_types=1);

namespace App\Integrations\AzurePipelines\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\AzurePipelines\Client;
use Illuminate\Support\Facades\Http;

final class ReleaseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $org, string $project, string $definition, ?string $environment = null): array
    {
        $response = Http::get("https://vsrm.dev.azure.com/{$org}/{$project}/_apis/release/releases", array_merge([
            'api-version'      => '6.0',
            '$top'             => '1',
            'definitionId'     => $definition,
            'deploymentStatus' => 'succedeed',
        ], $environment ? ['definitionEnvironmentId' => 'environment'] : []))->json('value.0');

        return [
            'label'       => 'Release Version',
            'status'      => $response['name'],
            'statusColor' => 'green.600',
        ];
    }
}
