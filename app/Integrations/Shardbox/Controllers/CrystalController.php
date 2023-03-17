<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Shardbox\Client;

final class CrystalController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $shard): array
    {
        preg_match('/Crystal<\\/span>\\s*<span[^>]*?>([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'       => 'crystal',
            'status'      => ExtractVersion::execute($matches[1]),
            'statusColor' => 'green.600',
        ];
    }
}
