<?php

declare(strict_types=1);

namespace App\Badges\Polymart;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.polymart.org/v1')->throw();
    }

    public function get(string $resourceId): array
    {
        return $this->client->get('getResourceInfo', ['resource_id' => $resourceId])->json('response.resource');
    }
}
