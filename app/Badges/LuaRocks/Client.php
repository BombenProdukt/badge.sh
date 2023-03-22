<?php

declare(strict_types=1);

namespace App\Badges\LuaRocks;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://luarocks.org')->throw();
    }

    public function get(string $user, string $moduleName): array
    {
        return $this->client->get("manifests/{$user}/manifest.json")->json('repository')[$moduleName];
    }
}
