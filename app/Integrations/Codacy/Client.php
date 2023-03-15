<?php

declare(strict_types=1);

namespace App\Integrations\Codacy;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.codacy.com/')->throw();
    }

    public function get(string $type, string $projectId, ?string $branch): string
    {
        return $this->client->get("project/badge/{$type}/{$projectId}", ['branch' => $branch])->body();
    }
}
