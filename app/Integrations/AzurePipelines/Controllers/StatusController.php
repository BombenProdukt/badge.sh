<?php

declare(strict_types=1);

namespace App\Integrations\AzurePipelines\Controllers;

use App\Integrations\AzurePipelines\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $org, string $project, string $definition, ?string $branch = null): array
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
