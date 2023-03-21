<?php

declare(strict_types=1);

namespace App\Badges\OPM;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://opm.openresty.org/api')->withoutRedirecting()->throw();
    }

    public function version(string $user, string $moduleName): string
    {
        return $this->client->head('pkg/fetch', [
            'account' => $user,
            'name'    => $moduleName,
        ])->header('location');
    }
}
