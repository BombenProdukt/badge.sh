<?php

declare(strict_types=1);

namespace App\Badges\AzurePipelines\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AzurePipelines\Client;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class DeploymentBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $organization, string $project, string $definition, ?string $environment = null): array
    {
        $response = Http::get("https://vsrm.dev.azure.com/{$organization}/{$project}/_apis/release/deployments", array_merge([
            'api-version'      => '6.0',
            '$top'             => '1',
            'definitionId'     => $definition,
            'deploymentStatus' => 'succedeed',
        ], $environment ? ['definitionenvironment' => 'environment'] : []))->json('value.0');

        return [
            'label'        => 'Deployment Version',
            'message'      => $response['release']['name'],
            'messageColor' => [
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

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/azure-pipelines/deployment-version/{organization}/{project}/{definition}/{environment?}',
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
            '/azure-pipelines/deployment-version/azuredevops-powershell/azuredevops-powershell/1' => 'deployment version',
        ];
    }
}
