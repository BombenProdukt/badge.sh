<?php

declare(strict_types=1);

namespace App\Badges\AzureDevOps\Badges;

use App\Enums\Category;
use Illuminate\Support\Facades\Http;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/azure-devops/status/{organization}/{project}/{definition}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
            '/azure-devops/status/dnceng/public/efcore-ci' => 'pipeline status (definition name)',
            '/azure-devops/status/dnceng/public/51' => 'pipeline status (definition id)',
        ];
    }
}
