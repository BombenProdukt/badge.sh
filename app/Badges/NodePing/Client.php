<?php

declare(strict_types=1);

namespace App\Badges\NodePing;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://nodeping.com')->throw();
    }

    public function status(string $uuid): bool
    {
        return $this->client->get("reports/results/{$uuid}/1", ['format' => 'json'])->json('0.su');
    }
}
