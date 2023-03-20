<?php

declare(strict_types=1);

namespace App\Badges\Coverity;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://scan.coverity.com/')->throw();
    }

    public function status(string $projectId): string
    {
        return $this->client->get("projects/{$projectId}/badge.json")->json('status');
    }
}
