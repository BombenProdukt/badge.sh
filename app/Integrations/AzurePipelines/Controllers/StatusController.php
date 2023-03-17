<?php

declare(strict_types=1);

namespace App\Integrations\AzurePipelines\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\AzurePipelines\Client;
use Illuminate\Support\Facades\Http;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $org, string $project, string $definition, ?string $branch = null): array
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
}
