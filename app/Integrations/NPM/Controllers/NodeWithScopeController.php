<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\NPM\Client;
use Illuminate\Routing\Controller;

final class NodeWithScopeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $package, string $tag = 'latest'): array
    {
        $response = $this->client->unpkg("{$scope}/{$package}@{$tag}/package.json");

        return [
            'label'       => 'node',
            'status'      => $response['engines']['node'],
            'statusColor' => 'green.600',
        ];
    }
}
