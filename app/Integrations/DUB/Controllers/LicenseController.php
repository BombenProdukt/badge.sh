<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\DUB\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $license = $this->client->get("{$package}/latest/info")['info'];

        return [
            'label'       => 'license',
            'status'      => $license,
            'statusColor' => 'green.600',
        ];
    }
}
