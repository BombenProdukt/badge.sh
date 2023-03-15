<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\Pub\Client;
use Illuminate\Routing\Controller;

final class PointsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = (float) $this->client->api("packages/{$package}/score");

        return [
            'label'       => 'popularity',
            'status'      => $response['grantedPoints'].'/'.$response['maxPoints'],
            'statusColor' => 'green.600',
        ];
    }
}
