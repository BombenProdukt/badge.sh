<?php

declare(strict_types=1);

namespace App\Integrations\DeepScan;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://deepscan.io/api/')->throw();
    }

    public function get(string $teamId, string $projectId, string $branchId): array
    {
        return collect($this->client->get("teams/{$teamId}/projects/{$projectId}/branches/{$branchId}/analyses")->json('data'))->last();
    }
}
