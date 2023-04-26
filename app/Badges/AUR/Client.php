<?php

declare(strict_types=1);

namespace App\Badges\AUR;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://aur.archlinux.org')->throw();
    }

    public function get(string $package): array
    {
        return $this->client->get('rpc', [
            'v' => 5,
            'type' => 'info',
            'arg' => $package,
        ])->json('results.0');
    }
}
