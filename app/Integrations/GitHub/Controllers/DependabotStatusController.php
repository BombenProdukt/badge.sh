<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class DependabotStatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        // Since there is no API to get dependabot status, for now check if file exists
        $request = Http::get("https://api.github.com/repos/{$owner}/{$repo}/contents/.github/dependabot.yml");

        if ($request->successful()) {
            return [
                'label'       => 'dependabot',
                'status'      => 'Active',
                'statusColor' => 'green.600',
            ];
        }

        return [
            'label'       => 'github',
            'status'      => 'not found',
            'statusColor' => 'gray.600',
        ];
    }
}
