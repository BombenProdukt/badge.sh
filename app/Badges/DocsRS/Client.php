<?php

declare(strict_types=1);

namespace App\Badges\DocsRS;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://docs.rs/crate/')->throw();
    }

    public function status(string $crate, ?string $version): bool
    {
        return $this->client->get("{$crate}/{$version}/builds.json")->json('0.build_status');
    }
}
