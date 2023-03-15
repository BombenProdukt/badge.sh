<?php

declare(strict_types=1);

namespace App\Integrations\MELPA;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
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
