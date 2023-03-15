<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\Bundlephobia\Client;
use Illuminate\Routing\Controller;

final class DependencyCountWithScopeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $name): array
    {
        return [
            'label'       => 'dependency count',
            'status'      => (string) $this->client->get("{$scope}/{$name}")['dependencyCount'],
            'statusColor' => 'blue.600',
        ];
    }
}
