<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.whatpulse.org')->throw();
    }

    public function get(string $userType, string $id): array
    {
        return $this->client->get("{$userType}.php", [
            $userType => $id,
            'format'  => 'json',
        ])->json();
    }
}
