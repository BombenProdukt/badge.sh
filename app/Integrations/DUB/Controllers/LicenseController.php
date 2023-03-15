<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\DUB\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $license = $this->client->get("{$package}/latest/info")['info'];

        return [
            'label'       => 'license',
            'status'      => $license,
            'statusColor' => 'green.600',
        ];
    }
}
