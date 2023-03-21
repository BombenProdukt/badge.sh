<?php

declare(strict_types=1);

namespace App\Badges\SecurityHeaders;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://securityheaders.com')->throw();
    }

    public function grade(string $url): string
    {
        return $this->client->head('/', [
            'q'               => $url,
            'hide'            => 'on',
            'followRedirects' => 'on',
        ])->header('x-grade');
    }
}
