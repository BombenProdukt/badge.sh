<?php

declare(strict_types=1);

namespace App\Badges\JitPack;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://jitpack.io/api')->throw();
    }

    public function version(string $groupId, string $artifactId): string
    {
        return $this->client->get("builds/{$groupId}/{$artifactId}/latestOk")->json('version');
    }
}
