<?php

declare(strict_types=1);

namespace App\Integrations\Reddit;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://www.reddit.com')->throw();
    }

    public function get(string $path): array
    {
        return $this->client->get($path)->json('data');
    }
}
