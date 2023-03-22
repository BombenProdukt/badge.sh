<?php

declare(strict_types=1);

namespace App\Badges\WordPress;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.wordpress.org')->throw();
    }

    public function installations(string $extensionType, string $extension, ?int $numberOfDays = null): int
    {
        return collecT($this->client->get("stats/{$extensionType}s/1.0/downloads.php", [
            'slug'  => $extension,
            'limit' => $numberOfDays,
        ])->json())->values()->sum();
    }

    public function downloads(string $extensionType, string $extension, ?int $numberOfDays = null): int
    {
        return collecT($this->client->get("stats/{$extensionType}s/1.0/downloads.php", [
            'slug'  => $extension,
            'limit' => $numberOfDays,
        ])->json())->values()->sum();
    }

    public function info(string $extensionType, string $extension): array
    {
        return $this->client->get("{$extensionType}s/info/1.2", [
            'action'  => "{$extensionType}_information",
            'request' => [
                'slug'   => $extension,
                'fields' => [
                    'active_installs' => 1,
                    'sections'        => 0,
                    'homepage'        => 0,
                    'tags'            => 0,
                    'screenshot_url'  => 0,
                    'downloaded'      => 1,
                    'last_updated'    => 1,
                    'requires_php'    => 1,
                ],
            ],
        ])->json();
    }
}
