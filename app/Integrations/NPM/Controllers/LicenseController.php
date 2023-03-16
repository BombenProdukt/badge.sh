<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\NPM\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package, string $tag = 'latest'): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->unpkg("{$package}@{$tag}/package.json")['license'],
            'statusColor' => 'blue.600',
        ];
    }
}
