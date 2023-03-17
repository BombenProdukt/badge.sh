<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\WAPM\Client;

final class ABIController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $abis = collect($this->client->get($package)['modules'])->map->abi->sort()->implode(' | ');

        return [
            'label'        => 'abi',
            'status'       => $abis,
            'statusColor'  => $abis ? 'blue.600' : 'green.600',
        ];
    }
}
