<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Packagist\Client;

final class NameController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $vendor, string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $package);

        return [
            'label'       => 'packagist',
            'status'      => $packageMeta['name'],
            'statusColor' => 'green.600',
        ];
    }
}
