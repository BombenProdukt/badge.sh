<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\NPM\Client;

final class VersionWithScopeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $scope, string $package, string $tag = 'latest'): array
    {
        return [
            'label'       => $tag === 'latest' ? 'npm' : "npm@{$tag}",
            'status'      => $this->client->unpkg("{$scope}/{$package}@{$tag}/package.json")['version'],
            'statusColor' => 'green.600',
        ];
    }
}
