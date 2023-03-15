<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\Actions\FormatBytes;
use App\Integrations\Bundlephobia\Client;
use Illuminate\Routing\Controller;

final class MinzipWithScopeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $name): array
    {
        return [
            'label'       => 'minzipped size',
            'status'      => FormatBytes::execute($this->client->get("{$scope}/{$name}")['gzip']),
            'statusColor' => 'blue.600',
        ];
    }
}
