<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\NPM\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package, string $tag = 'latest'): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->unpkg("{$package}@{$tag}/package.json")['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
