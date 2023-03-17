<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatBytes;
use App\Integrations\Bundlephobia\Client;

final class MinzipWithScopeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $scope, string $name): array
    {
        return [
            'label'       => 'minzipped size',
            'status'      => FormatBytes::execute($this->client->get("{$scope}/{$name}")['gzip']),
            'statusColor' => 'blue.600',
        ];
    }
}
