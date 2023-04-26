<?php

declare(strict_types=1);

namespace App\Badges\Codefactor;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://codefactor.io')->throw();
    }

    public function get(string $vcsType, string $user, string $repo, ?string $branch): string
    {
        return $this->client->get("repository/{$vcsType}/{$user}/{$repo}/badge/{$branch}")->body();
    }
}
