<?php

declare(strict_types=1);

namespace App\Integrations\OhDear\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\OhDear\Client;

final class TimezoneController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $domain): array
    {
        return [
            'label'       => $domain,
            'status'      => $this->client->get($domain)['timezone'],
            'statusColor' => 'blue.600',
        ];
    }
}
