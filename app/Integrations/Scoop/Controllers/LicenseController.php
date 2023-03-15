<?php

declare(strict_types=1);

namespace App\Integrations\Scoop\Controllers;

use App\Integrations\Scoop\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $app): array
    {
        $response = $this->client->main($app);

        return [
            'label'        => 'scoop',
            'status'       => $response['license'],
            'statusColor'  => 'blue.600',
        ];
    }
}
