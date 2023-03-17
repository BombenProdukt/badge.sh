<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\CRAN\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->db($package);

        return [
            'label'       => 'license',
            'status'      => preg_replace('/\s*\S\s+file\s+LICEN[CS]E$/i', '', $response['License']),
            'statusColor' => 'blue.600',
        ];
    }
}
