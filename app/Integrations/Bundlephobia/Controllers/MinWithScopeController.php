<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatBytes;
use App\Integrations\Bundlephobia\Client;

final class MinWithScopeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $scope, string $name): array
    {
        return [
            'label'       => 'minified size',
            'status'      => FormatBytes::execute($this->client->get("{$scope}/{$name}")['size']),
            'statusColor' => 'blue.600',
        ];
    }
}
