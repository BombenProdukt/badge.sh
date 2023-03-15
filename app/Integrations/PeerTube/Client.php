<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->get($package)->json();
    }
}
