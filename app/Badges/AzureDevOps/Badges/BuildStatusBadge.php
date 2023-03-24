<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AzureDevOps\Client;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class BuildStatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $organization, string $project, string $definition, ?string $branch = null): array
    {
        $response = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/build/builds", array_merge([
            'api-version'  => '6.0',
            '$top'         => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ], $branch ? ['branchName' => "refs/heads/{$branch}"] : []))->json('value.0');

        return [
            'label'        => 'Build',
            'message'      => $response['status'],
            'messageColor' => [
                'completed'          => 'green.600',
                'succeeded'          => 'green.600',
                'partiallySucceeded' => 'yellow.600',
                'failed'             => 'red.600',
            ][$response['status']],
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
            '/azure-devops/build-status/{organization}/{project}/{definition}/{branch?}',
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
            '/azure-devops/build-status/dnceng/public/51' => 'build status',
        ];
    }
}