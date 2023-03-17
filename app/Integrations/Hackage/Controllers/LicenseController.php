<?php

declare(strict_types=1);

namespace App\Integrations\Hackage\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Hackage\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->get($package)['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
