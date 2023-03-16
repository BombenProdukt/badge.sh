<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Controllers;

use App\Integrations\Packagist\Client;
use App\Integrations\Packagist\Concerns\HandlesVersions;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    use HandlesVersions;

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $vendor, string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $package);

        return [
            'label'       => 'license',
            'status'      => $packageMeta['versions'][$this->getVersion($packageMeta, $channel)]['license'][0] ?? 'unknown',
            'statusColor' => 'blue.600',
        ];
    }
}
