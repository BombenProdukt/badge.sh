<?php

declare(strict_types=1);

namespace App\Integrations\CPAN;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://fastapi.metacpan.org/v1/')->throw();
    }

    public function get(string $path, array $query = []): array
    {
        return $this->client->get(str_replace('::', '-', $path), $query)->json();
    }
}
