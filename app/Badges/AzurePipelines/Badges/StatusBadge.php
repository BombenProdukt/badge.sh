<?php

declare(strict_types=1);

namespace App\Badges\AzurePipelines\Badges;

use App\Badges\AzurePipelines\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $org, string $project, string $definition, ?string $branch = null): array
    {
        $svg = Http::get("https://dev.azure.com/{$org}/{$project}/_apis/build/status/{$definition}", ['branchName' => $branch])->body();

        preg_match_all('/fill-opacity=[^>]*?>([^<]+)<\//i', $svg, $texts);
        preg_match('/<rect[^>]*?fill="([^"]+)"[^>]*?x=/i', $svg, $colors);

        return [
            'label'       => $texts[1][0] ?: 'Azure Pipelines',
            'status'      => $texts[1][1],
            'statusColor' => trim(str_replace('#', '', $colors[1] ?? '')),
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
            '/azure-pipelines/{org}/{project}/{definition}/{branch?}',
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
            '/azure-pipelines/dnceng/public/efcore-ci' => 'pipeline status (definition name)',
            '/azure-pipelines/dnceng/public/51'        => 'pipeline status (definition id)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
