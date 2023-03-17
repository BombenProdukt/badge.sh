<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Bundlephobia\Client;

final class DependencyCountController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $name): array
    {
        return [
            'label'       => 'dependency count',
            'status'      => (string) $this->client->get($name)['dependencyCount'],
            'statusColor' => 'blue.600',
        ];
    }
}
