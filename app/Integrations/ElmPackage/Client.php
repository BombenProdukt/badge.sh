<?php

declare(strict_types=1);

namespace App\Integrations\ElmPackage;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://package.elm-lang.org/')->throw();
    }

    public function get(string $owner, string $name): array
    {
        return $this->client->get("packages/{$owner}/{$name}/latest/elm.json")->json();
    }
}
