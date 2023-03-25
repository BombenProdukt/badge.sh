<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class ReleaseBadge extends AbstractBadge
{
    protected array $routes = [
        '/azure-devops/release/{organization}/{project}/{definition}/{environment?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'release version',
                path: '/azure-devops/release/azuredevops-powershell/azuredevops-powershell/1',
                data: $this->render([]),
            ),
        ];
    }
}
