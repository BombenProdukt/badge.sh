<?php

declare(strict_types=1);

namespace App\Integrations\CTAN\Controllers;

use App\Integrations\CTAN\Client;
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
            'label'       => 'license',
            'status'      => $this->client->api($package)['license'],
            'statusColor' => 'green.600',
        ];
    }
}
