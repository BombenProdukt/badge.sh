<?php

declare(strict_types=1);

namespace App\Badges\Fedora;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://apps.fedoraproject.org/mdapi/')->throw();
    }

    public function version(string $packageName, ?string $branch): string
    {
        return $this->client->get("{$branch}/pkg/{$packageName}")->json('version');
    }
}
