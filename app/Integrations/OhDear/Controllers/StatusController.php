<?php

declare(strict_types=1);

namespace App\Integrations\OhDear\Controllers;

use App\Integrations\OhDear\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $domain, string $label): array
    {
        $site = collect($this->client->get($domain)['sites'])->flatten(1)->firstWhere('label', $label);

        return [
            'label'       => $label,
            'status'      => $site['status'],
            'statusColor' => $site['status'] === 'up' ? 'green.600' : 'red.600',
        ];
    }
}
