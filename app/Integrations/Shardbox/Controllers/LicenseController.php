<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Shardbox\Client;

final class LicenseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $shard): array
    {
        preg_match('/opensource.org\\/licenses\\/[^>]+?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'       => 'license',
            'status'      => $matches[1],
            'statusColor' => 'blue.600',
        ];
    }
}
