<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\CPAN\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $distribution): array
    {
        return [
            'label'       => 'license',
            'status'      => implode(' or ', $this->client->get("release/{$distribution}")['license']),
            'statusColor' => 'green.600',
        ];
    }
}
