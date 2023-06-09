<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class DeploymentBadge extends AbstractBadge
{
    protected string $route = '/azure-devops/deployment-version/{organization}/{project}/{definition}/{environment?}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $organization, string $project, string $definition, ?string $environment = null): array
    {
        $response = Http::get("https://vsrm.dev.azure.com/{$organization}/{$project}/_apis/release/deployments", \array_merge([
            'api-version' => '6.0',
            '$top' => '1',
            'definitionId' => $definition,
            'deploymentStatus' => 'succedeed',
        ], $environment ? ['definitionenvironment' => 'environment'] : []))->json('value.0');

        return [
            'status' => $response['deploymentStatus'],
            'version' => $response['release']['name'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'Deployment Version',
            'message' => $properties['version'],
            'messageColor' => [
                'succeeded' => 'green.600',
                'partiallySucceeded' => 'yellow.600',
                'failed' => 'red.600',
            ][$properties['status']],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'deployment version',
                path: '/azure-devops/deployment-version/azuredevops-powershell/azuredevops-powershell/1',
                data: $this->render(['status' => 'succeeded', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'deployment version',
                path: '/azure-devops/deployment-version/azuredevops-powershell/azuredevops-powershell/1',
                data: $this->render(['status' => 'partiallySucceeded', 'version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'deployment version',
                path: '/azure-devops/deployment-version/azuredevops-powershell/azuredevops-powershell/1',
                data: $this->render(['status' => 'failed', 'version' => '1.0.0']),
            ),
        ];
    }
}
