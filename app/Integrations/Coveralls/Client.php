<?php

declare(strict_types=1);

namespace App\Integrations\Coveralls;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://coveralls.io/repos/')
            ->throw()
            ->withoutRedirecting();
    }

    public function get(string $vcs, string $owner, string $repo, ?string $branch): string
    {
        return $this->client->get("{$vcs}/{$owner}/{$repo}/badge.svg", ['branch' => $branch])->body();
    }
}
