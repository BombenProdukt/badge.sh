<?php

declare(strict_types=1);

namespace App\Badges\AzurePipelines\Badges;

use App\Badges\AzurePipelines\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class ReleaseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $org, string $project, string $definition, ?string $environment = null): array
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
            '/azure-pipelines/release/version/{org}/{project}/{definition}/{environment?}',
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
            '/azure-pipelines/release/version/azuredevops-powershell/azuredevops-powershell/1' => 'release version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
