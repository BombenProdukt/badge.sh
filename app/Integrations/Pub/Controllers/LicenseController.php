<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\Pub\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->web("packages/{$package}");

        preg_match('/License<\/h3>\s*<p>([^(]+)\(/i', $response, $matches);

        return [
            'label'       => 'license',
            'status'      => trim(strip_tags($matches[1])),
            'statusColor' => 'blue.600',
        ];
    }
}
