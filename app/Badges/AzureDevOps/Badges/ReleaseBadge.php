<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AzureDevOps\Client;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class ReleaseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $organization, string $project, string $definition, ?string $environment = null): array
    {
        $response = Http::get("https://vsrm.dev.azure.com/{$organization}/{$project}/_apis/release/releases", array_merge([
            'api-version'      => '6.0',
            '$top'             => '1',
            'definitionId'     => $definition,
            'deploymentStatus' => 'succedeed',
        ], $environment ? ['definitionenvironment' => 'environment'] : []))->json('value.0');

        return [
            'label'        => 'Release Version',
            'message'      => $response['name'],
            'messageColor' => 'green.600',
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
