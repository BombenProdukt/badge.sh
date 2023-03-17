<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\WAPM\Client;

final class LicenseFromNamespaceController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $namespace, string $package): array
    {
        return [
            'label'        => 'license',
            'status'       => $this->client->get($package, $namespace)['license'],
            'statusColor'  => 'blue.600',
        ];
    }
}
