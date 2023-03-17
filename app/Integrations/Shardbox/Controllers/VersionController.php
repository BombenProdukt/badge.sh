<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Shardbox\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $shard): array
    {
        preg_match('/class="version">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'        => 'shards',
            'status'       => ExtractVersion::execute($matches[1]),
            'statusColor'  => ExtractVersionColor::execute($matches[1]),
        ];
    }
}
