<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://scrutinizer-ci.com/api')->throw();
    }

    public function get(string $vcs, string $user, string $repo): array
    {
        return $this->client->get("repositories/{$vcs}/{$user}/{$repo}")->json();
    }
}
