<?php

declare(strict_types=1);

namespace App\Integrations\Scoop\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Scoop\Client;

final class LicenseFromBucketController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $bucket, string $app): array
    {
        $response = $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);

        return [
            'label'        => $bucket === 'main' ? 'scoop' : 'scoop-extras',
            'status'       => $response['license'],
            'statusColor'  => 'blue.600',
        ];
    }
}
