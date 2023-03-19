<?php

declare(strict_types=1);

namespace App\Badges\Coveralls;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://coveralls.io/repos/')
            ->throw()
            ->withoutRedirecting();
    }

    public function get(string $vcs, string $repo, ?string $branch): string
    {
        return $this->client->get("{$vcs}/{$repo}/badge.svg", ['branch' => $branch])->body();
    }
}
