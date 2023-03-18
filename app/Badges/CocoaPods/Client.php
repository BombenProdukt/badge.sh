<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://trunk.cocoapods.org/api/v1')->throw();
    }

    public function get(string $pod): array
    {
        return $this->client->get("pods/{$pod}/specs/latest")->json();
    }
}
