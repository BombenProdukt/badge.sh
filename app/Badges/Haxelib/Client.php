<?php

declare(strict_types=1);

namespace App\Badges\Haxelib;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://lib.haxe.org/api/3.0/index.n')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->post('/', ['api', 'infos', $package])->json();
    }
}
