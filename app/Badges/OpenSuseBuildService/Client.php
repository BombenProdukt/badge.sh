<?php

declare(strict_types=1);

namespace App\Badges\OpenSuseBuildService;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://api.opensuse.org')->throw();

        if (config('services.open_suse_build_service.username') && config('services.open_suse_build_service.password')) {
            $this->client->withBasicAuth(config('services.open_suse_build_service.username'), config('services.open_suse_build_service.password'));
        }
    }

    public function get(string $project, string $packageName, string $repository, string $arch): string
    {
        return $this->client->get("build/{$project}/{$repository}/{$arch}/{$packageName}/_status")->json('status')['@_code'];
    }
}
