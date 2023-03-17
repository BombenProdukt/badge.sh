<?php

declare(strict_types=1);

namespace App\Integrations\Scoop\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Scoop\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $app): array
    {
        $response = $this->client->main($app);

        return [
            'label'        => 'scoop',
            'status'       => $response['license'],
            'statusColor'  => 'blue.600',
        ];
    }
}
