<?php

declare(strict_types=1);

namespace App\Integrations\OhDear\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\OhDear\Client;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $domain, string $label): array
    {
        $site = collect($this->client->get($domain)['sites'])->flatten(1)->firstWhere('label', $label);

        return [
            'label'       => $label,
            'status'      => $site['status'],
            'statusColor' => $site['status'] === 'up' ? 'green.600' : 'red.600',
        ];
    }
}
