<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Snapcraft\Client;

final class ArchitectureController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $snap): array
    {
        return [
            'label'       => 'architecture',
            'status'      => collect($this->client->get($snap)['channel-map'])->map->channel->map->architecture->unique()->implode(' | '),
            'statusColor' => 'blue.600',
        ];
    }
}
