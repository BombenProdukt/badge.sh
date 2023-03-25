<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class BuildStatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/azure-devops/build-status/{organization}/{project}/{definition}/{branch?}',
    ];

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
            'label' => 'Build',
            'message' => $properties['status'],
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
                name: 'build status',
                path: '/azure-devops/build-status/dnceng/public/51',
                data: $this->render(['status' => 'completed']),
            ),
            new BadgePreviewData(
                name: 'build status',
                path: '/azure-devops/build-status/dnceng/public/51',
                data: $this->render(['status' => 'succeeded']),
            ),
            new BadgePreviewData(
                name: 'build status',
                path: '/azure-devops/build-status/dnceng/public/51',
                data: $this->render(['status' => 'partiallySucceeded']),
            ),
            new BadgePreviewData(
                name: 'build status',
                path: '/azure-devops/build-status/dnceng/public/51',
                data: $this->render(['status' => 'failed']),
            ),
        ];
    }
}
