<?php

declare(strict_types=1);

namespace App\Integrations\PyPI;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://pypi.org/pypi/')->throw();
    }

    public function get(string $project): array
    {
        return $this->client->get("{$project}/json")->json('info');
    }
}
