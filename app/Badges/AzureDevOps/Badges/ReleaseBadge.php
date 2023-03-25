<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class ReleaseBadge extends AbstractBadge
{
    public function handle(string $organization, string $project, string $definition, ?string $environment = null): array
    {
        return [
            'version' => Http::get("https://vsrm.dev.azure.com/{$organization}/{$project}/_apis/release/releases", \array_merge([
                'api-version' => '6.0',
                '$top' => '1',
                'definitionId' => $definition,
                'deploymentStatus' => 'succedeed',
            ], $environment ? ['definitionenvironment' => 'environment'] : []))->json('value.0.name'),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/azure-devops/release/{organization}/{project}/{definition}/{environment?}',
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
            '/azure-devops/release/azuredevops-powershell/azuredevops-powershell/1' => 'release version',
        ];
    }
}
