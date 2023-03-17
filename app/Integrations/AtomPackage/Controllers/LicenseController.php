<?php

declare(strict_types=1);

namespace App\Integrations\AtomPackage\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\AtomPackage\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'license',
            'status'      => $response['versions'][$response['releases']['latest']]['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
