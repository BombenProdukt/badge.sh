<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\WAPM\Client;
use Illuminate\Routing\Controller;

final class ABIController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $abis = collect($this->client->get($package)['modules'])->map->abi->sort()->implode(' | ');

        return [
            'label'        => 'abi',
            'status'       => $abis,
            'statusColor'  => $abis ? 'blue.600' : 'green.600',
        ];
    }
}
