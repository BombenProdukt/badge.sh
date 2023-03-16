<?php

declare(strict_types=1);

namespace App\Integrations\Snapcraft\Controllers;

use App\Integrations\Snapcraft\Client;
use Illuminate\Routing\Controller;

final class ArchitectureController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $snap): array
    {
        return [
            'label'       => 'architecture',
            'status'      => collect($this->client->get($snap)['channel-map'])->map->channel->map->architecture->unique()->implode(' | '),
            'statusColor' => 'blue.600',
        ];
    }
}
