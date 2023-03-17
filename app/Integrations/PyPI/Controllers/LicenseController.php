<?php

declare(strict_types=1);

namespace App\Integrations\PyPI\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\PyPI\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $project): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->get($project)['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
