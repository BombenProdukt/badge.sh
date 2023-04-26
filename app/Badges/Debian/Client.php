<?php

declare(strict_types=1);

namespace App\Badges\Debian;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.ftp-master.debian.org')->throw();
    }

    public function version(string $packageName, ?string $distribution): array
    {
        return $this->client->get('madison', [
            'f' => 'json',
            's' => $distribution,
            'package' => $packageName,
        ])->json($distribution ? "0.{$packageName}.{$distribution}" : "0.{$packageName}");
    }
}
