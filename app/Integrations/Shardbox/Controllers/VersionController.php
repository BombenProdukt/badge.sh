<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Shardbox\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $shard): array
    {
        preg_match('/class="version">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'        => 'shards',
            'status'       => ExtractVersion::execute($matches[1]),
            'statusColor'  => ExtractVersionColor::execute($matches[1]),
        ];
    }
}