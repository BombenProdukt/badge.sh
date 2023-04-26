<?php

declare(strict_types=1);

namespace App\Badges\PuppetForge;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://forgeapi.puppetlabs.com/v3')->throw();
    }

    public function user(string $user): array
    {
        return $this->client->get("users/{$user}")->json();
    }

    public function module(string $user, string $module): array
    {
        return $this->client->get("modules/{$user}-{$module}")->json();
    }
}
