<?php

declare(strict_types=1);

namespace App\Badges\Netlify;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.netlify.com/api/v1')->throw();
    }

    public function status(string $projectId): string
    {
        return $this->client->get("badges/{$projectId}/deploy-status")->body();
    }
}
