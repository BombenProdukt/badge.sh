<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Pub\Client;

final class PointsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = (float) $this->client->api("packages/{$package}/score");

        return [
            'label'       => 'popularity',
            'status'      => $response['grantedPoints'].'/'.$response['maxPoints'],
            'statusColor' => 'green.600',
        ];
    }
}
