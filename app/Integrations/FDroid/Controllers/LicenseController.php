<?php

declare(strict_types=1);

namespace App\Integrations\FDroid\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\FDroid\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $appId): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->get($appId)['License'] ?? 'unknown',
            'statusColor' => 'blue.600',
        ];
    }
}
