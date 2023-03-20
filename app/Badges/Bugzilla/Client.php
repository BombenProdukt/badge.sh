<?php

declare(strict_types=1);

namespace App\Badges\Bugzilla;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://bugzilla.mozilla.org')->throw();
    }

    public function get(string $bug): array
    {
        return $this->client->get("rest/bug/{$bug}")->json('bugs.0');
    }
}
