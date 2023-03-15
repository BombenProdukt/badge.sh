<?php

declare(strict_types=1);

namespace App\Integrations\MozillaAddOns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

final class Client extends Controller
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://addons.mozilla.org/api/v3/')->throw();
    }

    public function get(string $name): array
    {
        return $this->client->get("addons/addon/{$name}")->json();
    }
}
