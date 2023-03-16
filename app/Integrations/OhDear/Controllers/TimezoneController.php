<?php

declare(strict_types=1);

namespace App\Integrations\OhDear\Controllers;

use App\Integrations\OhDear\Client;
use Illuminate\Routing\Controller;

final class TimezoneController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $domain): array
    {
        return [
            'label'       => $domain,
            'status'      => $this->client->get($domain)['timezone'],
            'statusColor' => 'blue.600',
        ];
    }
}
