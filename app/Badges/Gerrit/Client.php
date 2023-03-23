<?php

declare(strict_types=1);

namespace App\Badges\Gerrit;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://android-review.googlesource.com')->throw();
    }

    public function get(string $changeId): array
    {
        return json_decode(explode("\n", $this->client->get("changes/{$changeId}")->body())[1], true, JSON_THROW_ON_ERROR);
    }
}
