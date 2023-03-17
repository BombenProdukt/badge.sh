<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Pub\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
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
