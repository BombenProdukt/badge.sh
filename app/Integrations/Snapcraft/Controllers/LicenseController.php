<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Snapcraft\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $snap): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->get($snap)['snap']['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
