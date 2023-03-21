<?php

declare(strict_types=1);

namespace App\Badges\POEditor;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.poeditor.com/v2')->throw();
    }

    public function get(string $apiToken, string $projectId): array
    {
        return $this->client->post('language/list', [
            'api_token' => $apiToken,
            'id'        => $projectId,
        ])->json();
    }
}
