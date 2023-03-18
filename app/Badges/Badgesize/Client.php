<?php

declare(strict_types=1);

namespace App\Badges\Badgesize;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://img.badgesize.io/')->throw();
    }

    public function get(string $compression, string $path): array
    {
        return $this->client->get("{$path}.json", $compression !== 'normal' ? ['compression' => $compression] : [])->json();
    }
}
