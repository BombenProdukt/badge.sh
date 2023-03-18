<?php

declare(strict_types=1);

namespace App\Badges\MELPA;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://melpa.org')->throw();
    }

    public function get(string $package): string
    {
        return $this->client->get("packages/{$package}-badge.svg")->body();
    }
}
