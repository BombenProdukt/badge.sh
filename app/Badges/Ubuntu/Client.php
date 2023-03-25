<?php

declare(strict_types=1);

namespace App\Badges\Ubuntu;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.launchpad.net/1.0/ubuntu')->throw();
    }

    public function version(string $packageName, ?string $series): string
    {
        return $this->client->get('+archive/primary', [
            'distro_series' => $series ? "`https://api.launchpad.net/1.0/ubuntu/{$series}" : null,
            'exact_match' => 'true',
            'order_by_date' => 'true',
            'source_name' => $packageName,
            'status' => 'Published',
            'ws.op' => 'getPublishedSources',
        ])->json('entries.0.source_package_version');
    }
}
