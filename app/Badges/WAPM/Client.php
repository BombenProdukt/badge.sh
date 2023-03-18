<?php

declare(strict_types=1);

namespace App\Badges\WAPM;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://registry.wapm.io/')->throw();
    }

    public function get(string $package, string $namespace = '_'): array
    {
        if (str_contains($package, '/')) {
            [$namespace, $package] = explode('/', $package);
        }

        return $this->client->post('graphql', [
            'query'         => 'query packageQuery($name: String!, $version: String) { packageVersion: getPackageVersion(name: $name, version: $version) { version license createdAt distribution { size } commands { command module { name } } modules { name abi } } }',
            'operationName' => 'packageQuery',
            'variables'     => ['name' => "{$namespace}/{$package}"],
        ])->json('data.packageVersion');
    }
}
