<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/azure-devops/status/{organization}/{project}/{definition}/{branch?}';

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $organization, string $project, string $definition, ?string $branch = null): array
    {
        $svg = Http::get("https://dev.azure.com/{$organization}/{$project}/_apis/build/status/{$definition}", ['branchName' => $branch])->body();

        \preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $texts);
        \preg_match('/<rect[^>]*?fill="([^"]+)"[^>]*?x=/i', $svg, $colors);

        return [
            'pipeline' => $texts[1][0],
            'status' => $texts[1][1],
            'statusColor' => $colors[1],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['pipeline'] ?: 'Azure Pipelines',
            'message' => $properties['status'],
            'messageColor' => \trim(\str_replace('#', '', $properties['statusColor'] ?? '')),
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'pipeline status (definition name)',
                path: '/azure-devops/status/dnceng/public/efcore-ci',
                data: $this->render(['pipeline' => 'efcore-ci', 'status' => 'succeeded', 'statusColor' => '#28a745']),
            ),
            new BadgePreviewData(
                name: 'pipeline status (definition id)',
                path: '/azure-devops/status/dnceng/public/51',
                data: $this->render(['pipeline' => 'efcore-ci', 'status' => 'succeeded', 'statusColor' => '#28a745']),
            ),
        ];
    }
}
