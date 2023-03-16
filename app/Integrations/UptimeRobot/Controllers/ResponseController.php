<?php

declare(strict_types=1);

namespace App\Integrations\UptimeRobot\Controllers;

use App\Integrations\UptimeRobot\Client;
use Illuminate\Routing\Controller;

final class ResponseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $apiKey): array
    {
        return [
            'label'       => 'response',
            'status'      => $this->client->get($apiKey)['average_response_time'].'ms',
            'statusColor' => 'blue.600',
        ];
    }
}
