<?php

declare(strict_types=1);

namespace App\Integrations\Scoop\Controllers;

use App\Integrations\Scoop\Client;
use Illuminate\Routing\Controller;

final class LicenseFromBucketController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $bucket, string $app): array
    {
        $response = $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);

        return [
            'label'        => $bucket === 'main' ? 'scoop' : 'scoop-extras',
            'status'       => $response['license'],
            'statusColor'  => 'blue.600',
        ];
    }
}
