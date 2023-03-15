<?php

declare(strict_types=1);

namespace App\Integrations\OPAM;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://opam.ocaml.org/packages/')->throw();
    }

    public function get(string $package): string
    {
        return $this->client->get($package)->body();
    }
}
