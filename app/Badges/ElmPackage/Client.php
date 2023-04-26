<?php

declare(strict_types=1);

namespace App\Badges\ElmPackage;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://package.elm-lang.org/')->throw();
    }

    public function get(string $project): array
    {
        return $this->client->get("packages/{$owner}/{$name}/latest/elm.json")->json();
    }
}
