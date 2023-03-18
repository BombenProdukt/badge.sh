<?php

declare(strict_types=1);

namespace App\Badges\AzurePipelines\Badges;

use App\Badges\AzurePipelines\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class DeploymentBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $org, string $project, string $definition, ?string $environment = null): array
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
            '/azure-pipelines/deployment/version/{org}/{project}/{definition}/{environment?}',
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
        //
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
            '/azure-pipelines/deployment/version/azuredevops-powershell/azuredevops-powershell/1' => 'deployment version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
