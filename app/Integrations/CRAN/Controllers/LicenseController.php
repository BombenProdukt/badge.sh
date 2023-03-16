<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\CRAN\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->db($package);

        return [
            'label'       => 'license',
            'status'      => preg_replace('/\s*\S\s+file\s+LICEN[CS]E$/i', '', $response['License']),
            'statusColor' => 'blue.600',
        ];
    }
}
