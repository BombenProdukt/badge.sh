<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class BuildVersionBadge extends AbstractBadge
{
    protected string $route = '/azure-devops/build-version/{organization}/{project}/{definition}/{branch?}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $organization, string $project, string $definition, ?string $branch = null): array
    {
        return Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/build/builds", \array_merge([
            'api-version' => '6.0',
            '$top' => '1',
            'definitionId' => $definition,
            'statusFilter' => 'completed',
        ], $branch ? ['branchName' => "refs/heads/{$branch}"] : []))->json('value.0');
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'Build Version',
            'message' => $properties['buildNumber'],
            'messageColor' => [
                'completed' => 'green.600',
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
                name: 'build version',
                path: '/azure-devops/build-version/dnceng/public/51',
                data: $this->render(['buildNumber' => '1.0.0', 'status' => 'completed']),
            ),
            new BadgePreviewData(
                name: 'build version',
                path: '/azure-devops/build-version/dnceng/public/51',
                data: $this->render(['buildNumber' => '1.0.0', 'status' => 'succeeded']),
            ),
            new BadgePreviewData(
                name: 'build version',
                path: '/azure-devops/build-version/dnceng/public/51',
                data: $this->render(['buildNumber' => '1.0.0', 'status' => 'partiallySucceeded']),
            ),
            new BadgePreviewData(
                name: 'build version',
                path: '/azure-devops/build-version/dnceng/public/51',
                data: $this->render(['buildNumber' => '1.0.0', 'status' => 'failed']),
            ),
        ];
    }
}
