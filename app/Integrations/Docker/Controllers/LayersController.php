<?php

declare(strict_types=1);

namespace App\Integrations\Docker\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Docker\Client;

final class LayersController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(
        string $scope,
        string $name,
        string $tag = 'latest',
        string $architecture = 'amd64',
        string $variant = '',
    ): array {
        $response = $this->client->config($scope, $name, $tag, $architecture, $variant);

        return [
            'label'       => 'docker layers',
            'status'      => FormatNumber::execute(count($response['history'])),
            'statusColor' => 'blue.600',
        ];
    }
}
