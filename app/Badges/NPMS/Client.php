<?php

declare(strict_types=1);

namespace App\Badges\NPMS;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.npms.io/v2')->throw();
    }

    public function get(string $slug): array
    {
        return $this->client->get("package/{$slug}")->json('score');
    }
}
