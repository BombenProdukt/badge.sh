<?php

declare(strict_types=1);

namespace App\Integrations\PackagePhobia\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\PackagePhobia\Client;

final class PublishWithScopeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $scope, string $name): array
    {
        $response = $this->client->get("{$scope}/{$name}");

        return [
            'label'       => 'publish size',
            'status'      => $response['publish']['pretty'],
            'statusColor' => str_replace('#', '', $response['publish']['color']),
        ];
    }
}
