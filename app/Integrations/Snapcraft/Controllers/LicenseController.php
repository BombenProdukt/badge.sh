<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\Snapcraft\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $snap): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->get($snap)['snap']['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
