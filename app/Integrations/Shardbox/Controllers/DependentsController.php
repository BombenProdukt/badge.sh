<?php

declare(strict_types=1);

namespace App\Integrations\Shardbox\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Shardbox\Client;

final class DependentsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $shard): array
    {
        preg_match('/Dependents[^>]*? class="count">([^<]+)<\\//i', $this->client->get($shard), $matches);

        return [
            'label'        => 'dependents',
            'status'       => FormatNumber::execute((int) $matches[1]),
            'statusColor'  => 'green.600',
        ];
    }
}
