<?php

declare(strict_types=1);

namespace App\Integrations\CTAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\CTAN\Client;

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
            'status'      => $this->client->api($package)['license'],
            'statusColor' => 'green.600',
        ];
    }
}
