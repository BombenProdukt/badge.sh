<?php

declare(strict_types=1);

namespace App\Integrations\RubyGems\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\RubyGems\Client;

final class PlatformController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $gem): array
    {
        return [
            'label'       => 'platform',
            'status'      => $this->client->get("gems/{$gem}")['platform'],
            'statusColor' => 'green.600',
        ];
    }
}
