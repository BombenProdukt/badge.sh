<?php

declare(strict_types=1);

namespace App\Badges\HSTS;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://hstspreload.org/api/v2/')->throw();
    }

    public function status(string $domain): string
    {
        return $this->client->get('status', ['domain' => $domain])->json('status');
    }
}
