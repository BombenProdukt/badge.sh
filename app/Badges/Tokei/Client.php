<?php

declare(strict_types=1);

namespace App\Badges\Tokei;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://tokei.rs/b1')->acceptJson()->throw();
    }

    public function lines(string $provider, string $user, string $repo): int
    {
        return $this->client->get("{$provider}/{$user}/{$repo}")->json('lines');
    }
}
