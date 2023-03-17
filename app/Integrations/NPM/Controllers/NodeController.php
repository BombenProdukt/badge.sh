<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\NPM\Client;

final class NodeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->unpkg("{$package}@{$tag}/package.json");

        return [
            'label'       => 'node',
            'status'      => $response['engines']['node'],
            'statusColor' => 'green.600',
        ];
    }
}
