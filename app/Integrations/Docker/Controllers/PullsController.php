<?php

declare(strict_types=1);

namespace App\Integrations\Docker\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Docker\Client;

final class PullsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $scope, string $name): array
    {
        return [
            'label'       => 'docker pulls',
            'status'      => FormatNumber::execute($this->client->info($scope, $name)['pull_count']),
            'statusColor' => 'blue.600',
        ];
    }
}
