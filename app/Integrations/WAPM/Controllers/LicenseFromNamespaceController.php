<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\WAPM\Client;
use Illuminate\Routing\Controller;

final class LicenseFromNamespaceController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $namespace, string $package): array
    {
        return [
            'label'        => 'license',
            'status'       => $this->client->get($package, $namespace)['license'],
            'statusColor'  => 'blue.600',
        ];
    }
}
