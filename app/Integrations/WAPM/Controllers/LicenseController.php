<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\WAPM\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        return [
            'label'        => 'license',
            'status'       => $this->client->get($package)['license'],
            'statusColor'  => 'blue.600',
        ];
    }
}
