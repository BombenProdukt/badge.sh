<?php

declare(strict_types=1);

namespace App\Badges\Swagger;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://validator.swagger.io')->acceptJson()->throw();
    }

    public function debug(string $specUrl): array
    {
        return $this->client->get('validator/debug', ['url' => $specUrl])->json('schemaValidationMessages');
    }
}
