<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\WAPM\Client;
use Illuminate\Routing\Controller;

final class ABIFromNamespaceController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $namespace, string $package): array
    {
        $abis = collect($this->client->get($package, $namespace)['modules'])->map->abi->sort()->implode(' | ');

        return [
            'label'        => 'abi',
            'status'       => $abis,
            'statusColor'  => $abis ? 'blue.600' : 'green.600',
        ];
    }
}
