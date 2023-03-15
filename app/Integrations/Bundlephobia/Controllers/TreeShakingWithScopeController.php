<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\Bundlephobia\Client;
use Illuminate\Routing\Controller;

final class TreeShakingWithScopeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $name): array
    {
        $response        = $this->client->get("{$scope}/{$name}");
        $isTreeShakeable = $response['hasJSModule'] || $response['hasJSNext'];

        return [
            'label'       => 'tree shaking',
            'status'      => $isTreeShakeable ? 'supported' : 'not supported',
            'statusColor' => $isTreeShakeable ? 'green.600' : 'red.600',
        ];
    }
}
