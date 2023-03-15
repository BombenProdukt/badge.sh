<?php

declare(strict_types=1);

namespace App\Integrations\PackagePhobia\Controllers;

use App\Integrations\PackagePhobia\Client;
use Illuminate\Routing\Controller;

final class PublishWithScopeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $scope, string $name): array
    {
        $response = $this->client->get("{$scope}/{$name}");

        return [
            'label'       => 'publish size',
            'status'      => $response['publish']['pretty'],
            'statusColor' => str_replace('#', '', $response['publish']['color']),
        ];
    }
}
