<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\CPAN\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $distribution): array
    {
        return [
            'label'       => 'license',
            'status'      => implode(' or ', $this->client->get("release/{$distribution}")['license']),
            'statusColor' => 'green.600',
        ];
    }
}
