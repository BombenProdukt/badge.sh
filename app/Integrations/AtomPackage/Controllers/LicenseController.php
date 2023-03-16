<?php

declare(strict_types=1);

namespace App\Integrations\AtomPackage\Controllers;

use App\Integrations\AtomPackage\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'license',
            'status'      => $response['versions'][$response['releases']['latest']]['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
