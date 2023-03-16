<?php

declare(strict_types=1);

namespace App\Integrations\ChromeWebStore;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://chrome.google.com/webstore/detail/')->throw();
    }

    public function get(string $itemId): string
    {
        return $this->client->get($itemId)->body();
    }
}
